<?php


namespace zkrat\BasicPower\Helpers\Filter;



use zkrat\BasicPower\Abstracts\DataList;
use Nette\Utils\DateTime;

class CzPublicHolidays  extends DataList{

    const EASTER_FRIDAY='easter_friday';
    const EASTER_MONDAY='easter_monday';

    const DAYS=[
        '1.1.'=>'Nový rok',
        CzPublicHolidays::EASTER_FRIDAY=>'Velký pátek',
        CzPublicHolidays::EASTER_MONDAY=>'Velikonoční pondělí',
        '1.5.'=>'Svátek práce',
        '8.5.'=>'Den vítězství',
        '5.7.'=>'Den slovanských věrozvěstů Cyrila a Metoděje',
        '6.7.'=>'Den upálení mistra Jana Husa',
        '28.9.'=>'Den české státnosti',
        '28.10.'=>'Den vzniku samostatného československého státu',
        '17.11.'=>'Den boje za svobodu a demokracii',
        '24.12.'=>'Štědrý den',
        '25.12.'=>'1. svátek vánoční',
        '26.12.'=>'2. svátek vánoční',];


    private $year=null;


    public function __construct(int $year=NULL){
        if(is_null($year))
            $year= intval(date('Y'));
        $this->year = $year;
        $this->createDays();


    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        if($this->year != $year){
            $this->year = $year;
            $this->createDays();
        }

    }




    private function createDays(){
        $now= (new DateTime())->modifyClone('+ 1 day');
        $dateTimeEaster=DateTime::from(easter_date($this->year));
        foreach (CzPublicHolidays::DAYS as $date => $dayName){
            switch ($date){
                case CzPublicHolidays::EASTER_MONDAY:


                    $dateTime=$dateTimeEaster->modifyClone('next monday');
                    if($dateTime<$now){
                        $dateTime=DateTime::from(easter_date($this->year+1));
                        $dateTime=$dateTime->modifyClone('next monday');
                    }
                    break;
                case CzPublicHolidays::EASTER_FRIDAY:

                    $dateTime=$dateTimeEaster->modifyClone('last friday');
                    if($dateTime<$now){
                        $dateTime=DateTime::from(easter_date($this->year+1));
                        $dateTime=$dateTime->modifyClone('last friday');
                    }
                    break;
                default:
                    [$day,$month,$empty]=explode('.',$date,3);
                    $dateTime = DateTime::fromParts($this->year,$month,$day);
                    if($dateTime<$now){
                        $dateTime = DateTime::fromParts($this->year+1,$month,$day);
                    }
            }
            $this->addDay($dateTime,$dayName);
        }
        ksort($this->data);
//        $this->data=array_values($this->data);
    }


    private function addDay(DateTime $dateTime,string $dayName){
        $format =$dateTime->format(HelperDateTime::DATE_US);

        $this->data[$format] = [
            'datetime'=>$dateTime,

        ];
    }


    /**
     * @return false|int|string
     */
    public function getYear()
    {
        return $this->year;
    }


}