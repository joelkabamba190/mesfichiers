<?php
    
    
class Month {

    public $days = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
    public $months = ['Janvier','Fevrier','Mars','Avril','mai','Juin','Juillet',
    'Aout','Septembre','Octobre','Novembre','Decembre'];
    public $month;
    public $year;


    /**
     *  Month constructor
     *  @param int $month le mois compris entre 1 et 12
     *  @param int $year l'annee
     *  @throws \Exception
     */

     public function __construct(?int $month = null, ?int $year = null){

        if($month === null || $month < 1 || $month > 12){
            $month = intval(date('m'));
        }
        if($year === null){
            $year = intval(date('Y'));
        }
        $this->month = $month;
        $this->year = $year;

     }
     /**
      * Renvoie le premier jour du mois
      * @return \Datetime
      */
     public function getStartingDay(): \Datetime {
        return new \Datetime("{$this->year}-{$this->month}-01");

     }

     /**
      * retourne le mois en toute lettre (ex: Mars 2018)
      * @return string
      */

     public function toString(): string{
        return $this->months[$this->month - 1]. ' ' . $this->year;
     }

     /**
      * Renvoie le nombre de semaine dans le mois
      * @return int
      */

     public function getWeeks(): int{
         $start = $this->getStartingDay();
         $send = (clone $start)->modify('+1 month -1 day');
         $weeks = intval($send->format('W')) - intval($start->format('W')) + 1;
         if($weeks < 0){
             $weeks = intval($send->format('W'));
         }
         return $weeks;
     }
     /**
      * Est-ce que le jour est dans le mois en cours
      * @param \Datetime $date
      * @return bool
      */
     public function withinMonth(\Datetime $date): bool {
        return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
     }

     /**
      * Renvoie le mois suivant
      * @return Month
      */
     public function nextMonth(): Month 
     {
        $month = $this->month + 1;
        $year = $this->year;
        if($month > 12){
            $month = 1;
            $year += 1;
        }
        return new Month($month, $year);
     }

     /**
      * Renvoie le mois precedant
      * @return Month
      */

     public function previousMonth(): Month 
     {
        $month = $this->month - 1;
        $year = $this->year;
        if($month < 1){
            $month = 12;
            $year -= 1;
        }
        return new Month($month, $year);
     }
     
}


?>