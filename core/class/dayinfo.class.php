<?php

/* This file is part of Jeedom.
*
* Jeedom is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* Jeedom is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
*/

/* * ***************************Includes********************************* */
require_once dirname(__FILE__) . '/../../../../core/php/core.inc.php';
if (!class_exists('ICal')) { require_once dirname(__FILE__) . '/../../core/php/class.iCalReader.php'; }
if (!class_exists('MoonPhase')) { require_once dirname(__FILE__) . '/../../core/php/class.MoonPhase.php'; }
if (!class_exists('Season')) { require_once dirname(__FILE__) . '/../../core/php/class.Season.php'; }

class dayinfo extends eqLogic {


  public static function cronDaily() {
    foreach (eqLogic::byType('dayinfo') as $dayinfo) {
      if ($dayinfo->getIsEnable() == 1) {
        log::add('dayinfo', 'debug', 'pull daily');
        $dayinfo->getInformations();
      }
    }

  }

  public function postUpdate() {
    foreach (eqLogic::byType('dayinfo') as $dayinfo) {
      $dayinfoCmd = dayinfoCmd::byEqLogicIdAndLogicalId($dayinfo->getId(),'holiday');
      if (!is_object($dayinfoCmd)) {
        $dayinfoCmd = new dayinfoCmd();
        $dayinfoCmd->setName(__('Vacances', __FILE__));
        $dayinfoCmd->setEqLogic_id($this->id);
        $dayinfoCmd->setLogicalId('holiday');
        $dayinfoCmd->setConfiguration('data', 'holiday');
        $dayinfoCmd->setType('info');
      }
      $dayinfoCmd->setSubType('binary');
      $dayinfoCmd->save();

      $dayinfoCmd = dayinfoCmd::byEqLogicIdAndLogicalId($dayinfo->getId(),'nextholiday');
      if (!is_object($dayinfoCmd)) {
        $dayinfoCmd = new dayinfoCmd();
        $dayinfoCmd->setName(__('Prochaines Vacances', __FILE__));
        $dayinfoCmd->setEqLogic_id($this->id);
        $dayinfoCmd->setLogicalId('nextholiday');
        $dayinfoCmd->setConfiguration('data', 'nextholiday');
        $dayinfoCmd->setType('info');
      }
      $dayinfoCmd->setSubType('numeric');
      $dayinfoCmd->save();

      $dayinfoCmd = dayinfoCmd::byEqLogicIdAndLogicalId($dayinfo->getId(),'nextendholiday');
      if (!is_object($dayinfoCmd)) {
        $dayinfoCmd = new dayinfoCmd();
        $dayinfoCmd->setName(__('Prochaines Fin Vacances', __FILE__));
        $dayinfoCmd->setEqLogic_id($this->id);
        $dayinfoCmd->setLogicalId('nextendholiday');
        $dayinfoCmd->setConfiguration('data', 'nextendholiday');
        $dayinfoCmd->setType('info');
      }
      $dayinfoCmd->setSubType('numeric');
      $dayinfoCmd->save();

      $dayinfoCmd = dayinfoCmd::byEqLogicIdAndLogicalId($dayinfo->getId(),'nholiday');
      if (!is_object($dayinfoCmd)) {
        $dayinfoCmd = new dayinfoCmd();
        $dayinfoCmd->setName(__('Label Vacances', __FILE__));
        $dayinfoCmd->setEqLogic_id($this->id);
        $dayinfoCmd->setLogicalId('nholiday');
        $dayinfoCmd->setConfiguration('data', 'nholiday');
        $dayinfoCmd->setType('info');
      }
      $dayinfoCmd->setSubType('string');
      $dayinfoCmd->save();

      $dayinfoCmd = dayinfoCmd::byEqLogicIdAndLogicalId($dayinfo->getId(),'moon');
      if (!is_object($dayinfoCmd)) {
        $dayinfoCmd = new dayinfoCmd();
        $dayinfoCmd->setName(__('Phase de la Lune', __FILE__));
        $dayinfoCmd->setEqLogic_id($this->id);
        $dayinfoCmd->setLogicalId('moon');
        $dayinfoCmd->setConfiguration('data', 'moon');
        $dayinfoCmd->setType('info');
      }
      $dayinfoCmd->setSubType('numeric');
      $dayinfoCmd->save();

      $dayinfoCmd = dayinfoCmd::byEqLogicIdAndLogicalId($dayinfo->getId(),'amoon');
      if (!is_object($dayinfoCmd)) {
        $dayinfoCmd = new dayinfoCmd();
        $dayinfoCmd->setName(__('Age de la Lune', __FILE__));
        $dayinfoCmd->setEqLogic_id($this->id);
        $dayinfoCmd->setLogicalId('amoon');
        $dayinfoCmd->setConfiguration('data', 'amoon');
        $dayinfoCmd->setType('info');
      }
      $dayinfoCmd->setSubType('numeric');
      $dayinfoCmd->save();

      $dayinfoCmd = dayinfoCmd::byEqLogicIdAndLogicalId($dayinfo->getId(),'nseason');
      if (!is_object($dayinfoCmd)) {
        $dayinfoCmd = new dayinfoCmd();
        $dayinfoCmd->setName(__('Prochaine Saison', __FILE__));
        $dayinfoCmd->setEqLogic_id($this->id);
        $dayinfoCmd->setLogicalId('nseason');
        $dayinfoCmd->setConfiguration('data', 'nseason');
        $dayinfoCmd->setType('info');
      }
      $dayinfoCmd->setSubType('numeric');
      $dayinfoCmd->save();

      $dayinfoCmd = dayinfoCmd::byEqLogicIdAndLogicalId($dayinfo->getId(),'season');
      if (!is_object($dayinfoCmd)) {
        $dayinfoCmd = new dayinfoCmd();
        $dayinfoCmd->setName(__('Saison', __FILE__));
        $dayinfoCmd->setEqLogic_id($this->id);
        $dayinfoCmd->setLogicalId('season');
        $dayinfoCmd->setConfiguration('data', 'season');
        $dayinfoCmd->setType('info');
      }
      $dayinfoCmd->setSubType('string');
      $dayinfoCmd->save();

      $dayinfoCmd = dayinfoCmd::byEqLogicIdAndLogicalId($dayinfo->getId(),'weekend');
      if (!is_object($dayinfoCmd)) {
        $dayinfoCmd = new dayinfoCmd();
        $dayinfoCmd->setName(__('Weekend', __FILE__));
        $dayinfoCmd->setEqLogic_id($this->id);
        $dayinfoCmd->setLogicalId('weekend');
        $dayinfoCmd->setConfiguration('data', 'weekend');
        $dayinfoCmd->setType('info');
      }
      $dayinfoCmd->setSubType('binary');
      $dayinfoCmd->save();

      $dayinfoCmd = dayinfoCmd::byEqLogicIdAndLogicalId($dayinfo->getId(),'nholiday');
      if (!is_object($dayinfoCmd)) {
        $dayinfoCmd = new dayinfoCmd();
        $dayinfoCmd->setName(__('Label Vacances', __FILE__));
        $dayinfoCmd->setEqLogic_id($this->id);
        $dayinfoCmd->setLogicalId('nholiday');
        $dayinfoCmd->setConfiguration('data', 'nholiday');
        $dayinfoCmd->setType('info');
      }
      $dayinfoCmd->setSubType('string');
      $dayinfoCmd->save();

      $dayinfoCmd = dayinfoCmd::byEqLogicIdAndLogicalId($dayinfo->getId(),'redday');
      if (!is_object($dayinfoCmd)) {
        $dayinfoCmd = new dayinfoCmd();
        $dayinfoCmd->setName(__('Férié', __FILE__));
        $dayinfoCmd->setEqLogic_id($this->id);
        $dayinfoCmd->setLogicalId('redday');
        $dayinfoCmd->setConfiguration('data', 'redday');
        $dayinfoCmd->setType('info');
      }
      $dayinfoCmd->setSubType('binary');
      $dayinfoCmd->save();

      $dayinfoCmd = dayinfoCmd::byEqLogicIdAndLogicalId($dayinfo->getId(),'nredday');
      if (!is_object($dayinfoCmd)) {
        $dayinfoCmd = new dayinfoCmd();
        $dayinfoCmd->setName(__('Prochain Férié', __FILE__));
        $dayinfoCmd->setEqLogic_id($this->id);
        $dayinfoCmd->setLogicalId('nredday');
        $dayinfoCmd->setConfiguration('data', 'nredday');
        $dayinfoCmd->setType('info');
      }
      $dayinfoCmd->setSubType('numeric');
      $dayinfoCmd->save();

      if ($dayinfo->getIsEnable() == 1) {
        log::add('dayinfo', 'debug', 'pull cron');
        $dayinfo->getInformations();
      }
    }
  }

  /*     * **********************Getteur Setteur*************************** */

  /* Fonctions */
  public function isNotWorkable($country,$region){
    $timestamp = strtotime("today");

    $year = date("Y", $timestamp);
    $holidays = dayinfo::getHolidays($country,$region,$year);

    $return = in_array($timestamp, $holidays);
    return intval($return);
  }

  /*
  * Cette fonction retourne un tableau de timestamp correspondant
  * aux jours fériés en France pour une année donnée.
  */
  public function getHolidays($country,$region, $year=null)		{
    if ($year === null) $year = date("Y");

    $easterDate  = easter_date($year);
    $easterDay   = date("j", $easterDate);
    $easterMonth = date("n", $easterDate);
    $easterYear   = date("Y", $easterDate);

    $holidays = array();

    if ($country == "france")
    {
      // Dates fixes
      $holidays[] = mktime(0, 0, 0, 1,  1,  $year);  // 1er janvier
      $holidays[] = mktime(0, 0, 0, 5,  1,  $year);  // Fête du travail
      $holidays[] = mktime(0, 0, 0, 5,  8,  $year);  // Victoire des alliés 1945
      $holidays[] = mktime(0, 0, 0, 7,  14, $year);  // Fête nationale
      $holidays[] = mktime(0, 0, 0, 8,  15, $year);  // Assomption
      $holidays[] = mktime(0, 0, 0, 11, 1,  $year);  // Toussaint
      $holidays[] = mktime(0, 0, 0, 11, 11, $year);  // Armistice 1918
      $holidays[] = mktime(0, 0, 0, 12, 25, $year);  // Noel

      // Dates variables
      $holidays[] = mktime(0, 0, 0, $easterMonth, $easterDay + 1,  $easterYear); // Lundi de Paques
      $holidays[] = mktime(0, 0, 0, $easterMonth, $easterDay + 39, $easterYear); // Ascension
      $holidays[] = mktime(0, 0, 0, $easterMonth, $easterDay + 50, $easterYear); // Lundi Pentecote

      if ($region == "AL") {
        $holidays[] = mktime(0, 0, 0, $easterMonth, $easterDay - 2,  $easterYear); // Vendredi Saint
        $holidays[] = mktime(0, 0, 0, 12, 26, $year);  // Saint Etienne
      } else if ($region == "martinique") {
        $holidays[] = mktime(0, 0, 0, 5, 22, $year);  // Abolition esclavage
        $antilles = true;
      } else if ($region == "guadeloupe") {
        $holidays[] = mktime(0, 0, 0, 5, 27, $year);  // Abolition esclavage
        $antilles = true;
      } else if ($region == "saint-martin") {
        $holidays[] = mktime(0, 0, 0, 5, 27, $year);  // Abolition esclavage
        $antilles = true;
      } else if ($region == "guyane") {
        $holidays[] = mktime(0, 0, 0, 6, 10, $year);  // Abolition esclavage
      } else if ($region == "saint-barthelemy") {
        $holidays[] = mktime(0, 0, 0, 10, 9, $year);  // Abolition esclavage
        $antilles = true;
      } else if ($region == "reunion") {
        $holidays[] = mktime(0, 0, 0, 12, 20, $year);  // Abolition esclavage
      }

      if ($region == "guadeloupe" || $region == "saint-martin" || $region == "saint-barthelemy") {
        $holidays[] = mktime(0, 0, 0, $easterMonth, $easterDay - 47,  $easterYear); // Mardi Gras
        $holidays[] = mktime(0, 0, 0, $easterMonth, $easterDay - 46,  $easterYear); // Mercredi Gras
        $holidays[] = mktime(0, 0, 0, $easterMonth, $easterDay - 2,  $easterYear); // Vendredi Saint
        $holidays[] = mktime(0, 0, 0, 11, 2, $year);  // Fete des Morts
      }
    }
    else if ($country == "belgique")
    {
      // Dates fixes
      $holidays[] = mktime(0, 0, 0, 1,  1,  $year);  // 1er janvier
      $holidays[] = mktime(0, 0, 0, 5,  1,  $year);  // Fête du travail
      $holidays[] = mktime(0, 0, 0, 7,  21, $year);  // Fête nationale
      $holidays[] = mktime(0, 0, 0, 8,  15, $year);  // Assomption
      $holidays[] = mktime(0, 0, 0, 11, 1,  $year);  // Toussaint
      $holidays[] = mktime(0, 0, 0, 11, 11, $year);  // Armistice 1918
      $holidays[] = mktime(0, 0, 0, 12, 25, $year);  // Noel

      // Dates variables
      $holidays[] = mktime(0, 0, 0, $easterMonth, $easterDay + 1,  $easterYear); // Lundi de Paques
      $holidays[] = mktime(0, 0, 0, $easterMonth, $easterDay + 39, $easterYear); // Ascension
      $holidays[] = mktime(0, 0, 0, $easterMonth, $easterDay + 50, $easterYear); // Lundi Pentecote
    }
    else if ($country == "suisse")
    {
      // Dates fixes
      $holidays[] = mktime(0, 0, 0, 1,  1,  $year);  // 1er janvier
      $holidays[] = mktime(0, 0, 0, 8,  1, $year);  // Fête nationale
      $holidays[] = mktime(0, 0, 0, 12, 25, $year);  // Noel

      // Dates variables
      $holidays[] = mktime(0, 0, 0, $easterMonth, $easterDay + 1,  $easterYear); // Lundi de Paques
      $holidays[] = mktime(0, 0, 0, $easterMonth, $easterDay + 39, $easterYear); // Ascension
      $holidays[] = mktime(0, 0, 0, $easterMonth, $easterDay + 50, $easterYear); // Lundi Pentecote

      $canton_inarray = array(
        mktime(0, 0, 0, 1,  2,  $year) => array("AG", "BE", "FR", "GL", "JU", "LU", "NE", "OW", "SH", "SO", "VD", "ZG", "ZH"),
        mktime(0, 0, 0, 1,  6,  $year) => array("SZ", "TI", "UR"),
        mktime(0, 0, 0, 3,  1,  $year) => array("NE"),
        mktime(0, 0, 0, 3, 19,  $year) => array(/*"LU", */"NW", "SZ", "TI", "UR", "VS"), // LU demi journee ???
          mktime(0, 0, 0, 5,  1,  $year) => array("BL", "BS", "GE", "JU", "NE", "SH", "TI", "UR", "ZH"),
          mktime(0, 0, 0, 6, 23,  $year) => array("JU"),
          mktime(0, 0, 0, 6, 29,  $year) => array("TI"),
          mktime(0, 0, 0, 8, 15,  $year) => array("AG", "AI", "FR", "JU", "LU", "NW", "OW", "SO", "SZ", "TI", "UR", "VS", "ZG"),
          mktime(0, 0, 0, 9, 25,  $year) => array("OW"),
          mktime(0, 0, 0, 11, 1,  $year) => array("AG", "AI", "FR", "GL", "JU", "LU", "NW", "OW", "SG", "SO", "TI", "UR", "VS", "ZG"),
          mktime(0, 0, 0, 12, 8,  $year) => array("AG", "FR", "LU", "NW", "OW", "TI", "UR", "VS", "ZG"),
          mktime(0, 0, 0, 12,31,  $year) => array("GE")
        );
        $canton_outarray = array( // not in array
          mktime(0, 0, 0, $easterMonth, $easterDay - 2,  $easterYear) => array("TI", "VS"), // vendredi saint
          mktime(0, 0, 0, 12,26,  $year) => array("GE", "JU", "NE", "VD", "VS"), // saint etienne // NE si 25/12 dimanche
        );

        if ($region == "NE" && date("N", mktime(0, 0, 0, 12, 25, $year)) == 7) { // Si region NE et 25/12 dimanche
          $holidays[] = mktime(0, 0, 0, 12,26,  $year); // saint etienne
        }

        if ($region == "GL") {
          //		mktime(0, 0, 0, 1,  1,  $year) => array("GL"), // fahrtsfest
          $holidays[] = strtotime("first thursday of april", mktime(0, 0, 0, 1,  1,  $year));
        }

        $fetedieu_array = array("AG", "AI", "FR", "JU", "LU", /*"NE", */"NW", "OW", "SO", "SZ", "TI", "UR", "VS", "ZG"); // NE 2 communes seulement
        if (in_array($region, $fetedieu_array)) {
          $holidays[] = mktime(0, 0, 0, $easterMonth, $easterDay + 60, $easterYear); // Jeudi qui suit le Dimanche de la Trinite (Dimanche qui suit la Pentecote)
        }

        if ($region == "GE") { // "jeune genevois" => array("GE")
          $firstdimofsept = strtotime("first sunday of september", mktime(0, 0, 0, 1,  1,  $year));
          $holidays[] = strtotime("+4 days", $firstdimofsept);
        }

        if ($region == "NE" || $region == "VD") { // "jeune federal" => array("NE", "VD")
          $thirddimofsept = strtotime("third sunday of september", mktime(0, 0, 0, 1,  1,  $year));
          $holidays[] = strtotime("+1 days", $thirddimofsept);
        }

        foreach($canton_inarray as $date => $inarray) {
          if (in_array($region, $inarray)) {
            $holidays[] = $date;
          }
        }
        foreach($canton_outarray as $date => $outarray) {
          if (!empty($region) && !in_array($region, $outarray)) {
            $holidays[] = $date;
          }
        }
      }
      else if ($country == "canada")
      {
        // Dates fixes
        $holidays[] = mktime(0, 0, 0, 1,  1,  $year);  // 1er janvier
        $holidays[] = strtotime("previous monday", mktime(0, 0, 0, 5, 25,  $year)); // Lundi avant la Fete de la Reine
        $holidays[] = mktime(0, 0, 0, 7,  1,  $year);  // Fête du Canada
        $holidays[] = strtotime("first monday of september", mktime(0, 0, 0, 1,  1,  $year)); // Fete du Travail
        $holidays[] = strtotime("second monday of october", mktime(0, 0, 0, 1,  1,  $year)); // Action de Grace
        $holidays[] = mktime(0, 0, 0, 12, 25, $year);  // Noel

        // Dates variables
        $holidays[] = mktime(0, 0, 0, $easterMonth, $easterDay - 2,  $easterYear); // Vendredi Saint
        $holidays[] = $easterDate;
        $holidays[] = mktime(0, 0, 0, $easterMonth, $easterDay + 1,  $easterYear); // Lundi de Paques

        if ($region == "QC") {
          if (date("N", mktime(0, 0, 0, 7, 1, $year)) == 7) { // Si 1/7 dimanche
            $holidays[] = mktime(0, 0, 0, 7, 2,  $year);
          }
          $holidays[] = mktime(0, 0, 0, 6, 24,  $year); // Fete nationale (Quebec)
        }
        /*	if () {// Ville particuliere ???
        $holidays[] = strtotime("first monday of august", mktime(0, 0, 0, 1,  1,  $year)); // Fete Civique
      }
      */
      if ($region != "QC") {
        $holidays[] = mktime(0, 0, 0, 11, 11, $year);  // Armistice 1918
      }
    }

    sort($holidays);

    return $holidays;
  }

  public function nextHoliday($country,$region,$year=null)	{
    $now = time();
    $next_holiday = null;
    $holidays = dayinfo::getHolidays($country,$region,$year);
    foreach($holidays as $key => $holiday_timestamp) {
      if ($holiday_timestamp >= $now) {
        $next_holiday = $holiday_timestamp;
        break;
      }
    }

    return $next_holiday;
  }

  public function getNextHoliday($country,$region)		{
    $next_holiday = dayinfo::nextHoliday($country,$region); // get first next holiday for current year
    if ($next_holiday === null) { // no holiday for current year
      $next_year = date("Y") + 1; // next year
      $next_holiday = dayinfo::nextHoliday($country,$region,$next_year); // get first next holiday for next year
    }

    return $next_holiday;
  }

  public function getDifftoNextHoliday($country,$region,$format="%a")		{
    $next_holiday = dayinfo::getNextHoliday($country,$region);

    $date_next_holiday = date_create("@".strtotime("today", $next_holiday));
    $current_date = date_create("@".strtotime("today"));

    $diff = date_diff($current_date, $date_next_holiday);

    return $diff->format($format);
  }

  // For the current date
  public function isTodayWeekend() {
    $currentDate = new DateTime("now");
    if ($currentDate->format('N') >= 6)
    { return '1';}
    else
    { return '0';}
  }


  public function getInformations() {
    $country = $this->getConfiguration('country');
    $region = $this->getConfiguration('zone');
    log::add('dayinfo', 'info', 'getInformations');
    $weekend = dayinfo::isTodayWeekend();
    log::add('dayinfo', 'debug', 'Weekend ' . $weekend);
    $redday = dayinfo::isNotWorkable($country,$region);
    log::add('dayinfo', 'debug', 'Redday ' . $redday);
    $nredday = dayinfo::getDifftoNextHoliday($country,$region);
    log::add('dayinfo', 'debug', 'Nredday ' . $nredday);

    $season = new Season();
    $aseason = $season->getSeason();
    $nseason = $season->getNextSeasonNbDays();
    log::add('dayinfo', 'debug', 'Season ' . $aseason);
    log::add('dayinfo', 'debug', 'Next Season ' . $nseason);

    $holiday = '0';
    $nholiday = '-';

    //build calendar ID
    if ($country == 'france') {
      if ($region == 'A' | $region == 'B' | $region == 'C') {
        $calendarid = $country . $region;
      } else {
        $calendarid = $country . 'B';
      }
    } else {
      $calendarid = $country;
    }
    $icaddr = dirname(__FILE__) . '/../../resources/' . $calendarid . '.ics';
    $ical   = new ICal($icaddr);
    log::add('dayinfo', 'debug', 'Ical ' . $icaddr);

    $events = $ical->events();
    //$timestamp = strtotime("12/30/2015");
    $timestamp = strtotime("today");
    $datetoday = date_create("today");
    $diffday = 365;
    $diffend = 365;
    $summerholiday = 0;

    foreach ($events as $event) {
      if (isset($event['DTEND']))
      {
        $datehol = date_create($event['DTSTART']);
        if ($datetoday < $datehol) {
        $diff = date_diff($datetoday, $datehol);
        if ($diff->format('%a') < $diffday && $diff->format('%a') > 0) {
          $diffday = $diff->format('%a');
        }
        log::add('dayinfo', 'debug', 'Event ' . $event['DTSTART'] . ' dans ' . $diff->format('%a'));
       }
       $datefin = date_create($event['DTEND']);
       if ($datetoday < $datefin) {
       $diff = date_diff($datetoday, $datefin);
       if ($diff->format('%a') < $diffend && $diff->format('%a') > 0) {
         $diffend = $diff->format('%a');
       }
       log::add('dayinfo', 'debug', 'Event End ' . $event['DTEND'] . ' dans ' . $diff->format('%a'));
        }
       if ($ical->iCalDateToUnixTimestamp($event['DTSTART']) <= $timestamp && $timestamp < $ical->iCalDateToUnixTimestamp($event['DTEND']))
       {
         $holiday = '1';
         $nholiday = $event['SUMMARY'];
       }
      }
      else {
        if ($event['DESCRIPTION'] == "Vacances d'été" && $ical->iCalDateToUnixTimestamp($event['DTSTART']) <= $timestamp && strpos($event['DTSTART'], date(Y))) {
          //post debut vacances d'été (label vacances, date supérieure et on est bien sur l'année en cours)
          $summerholiday = 1;
        }
        if ($event['DESCRIPTION'] == "Rentrée scolaire des élèves" && $ical->iCalDateToUnixTimestamp($event['DTSTART']) <= $timestamp) {
          //post reprise (label rentrée, date supérieure)
          $summerholiday = 0;
        }

      }
    }

    if ($summerholiday == 1) {
      $holiday = '1';
      $nholiday = "Vacances d'été";
    }

    log::add('dayinfo', 'debug', 'Holiday ' . $holiday);
    log::add('dayinfo', 'debug', 'Label ' . $nholiday);
    log::add('dayinfo', 'debug', 'Next Holiday ' . $diffday);
    log::add('dayinfo', 'debug', 'Next End Holiday ' . $diffend);

    $moon = new Solaris\MoonPhase();
    $age = round( $moon->age(), 1 ); // age de la lune en jour
    $phase = $moon->phase(); //0 et 1 nouvelle lune, 0,5 pleine lune
    log::add('dayinfo', 'debug', 'Phase Lune ' . $phase);
    log::add('dayinfo', 'debug', 'Age Lune ' . $age);

    foreach ($this->getCmd() as $cmd) {
      if($cmd->getConfiguration('data')=="weekend"){
        $cmd->setConfiguration('value', $weekend);
        $cmd->save();
        $cmd->event($weekend);
      }elseif($cmd->getConfiguration('data')=="redday"){
        $cmd->setConfiguration('value', $redday);
        $cmd->save();
        $cmd->event($redday);
      }elseif($cmd->getConfiguration('data')=="nredday"){
        $cmd->setConfiguration('value', $nredday);
        $cmd->save();
        $cmd->event($nredday);
      }elseif($cmd->getConfiguration('data')=="season"){
        $cmd->setConfiguration('value', $aseason);
        $cmd->save();
        $cmd->event($aseason);
      }elseif($cmd->getConfiguration('data')=="nseason"){
        $cmd->setConfiguration('value', $nseason);
        $cmd->save();
        $cmd->event($nseason);
      }elseif($cmd->getConfiguration('data')=="holiday"){
        $cmd->setConfiguration('value', $holiday);
        $cmd->save();
        $cmd->event($holiday);
      }elseif($cmd->getConfiguration('data')=="nholiday"){
        $cmd->setConfiguration('value', $nholiday);
        $cmd->save();
        $cmd->event($nholiday);
      }elseif($cmd->getConfiguration('data')=="nextholiday"){
        $cmd->setConfiguration('value', $diffday);
        $cmd->save();
        $cmd->event($diffday);
      }elseif($cmd->getConfiguration('data')=="nextendholiday"){
        $cmd->setConfiguration('value', $diffend);
        $cmd->save();
        $cmd->event($diffend);
      }elseif($cmd->getConfiguration('data')=="moon"){
        $cmd->setConfiguration('value', $phase);
        $cmd->save();
        $cmd->event($phase);
      }elseif($cmd->getConfiguration('data')=="amoon"){
        $cmd->setConfiguration('value', $age);
        $cmd->save();
        $cmd->event($age);
      }
    }
    return ;
  }

  public function getInfo($_infos = '') {
    $return = array();

    $return['id'] = array(
      'value' => $this->getId(),
    );

    return $return;
  }

  public function getZones($country) {
    if ($country == "france") {
      $return['A'] = array(
        'value' => 'Zone A',
      );
      $return['B'] = array(
        'value' => 'Zone B',
      );
      $return['C'] = array(
        'value' => 'Zone C',
      );
      $return['AL'] = array(
        'value' => 'Alsace-Lorraine',
      );
      $return['martinique'] = array(
        'value' => 'Martinique',
      );
      $return['guadeloupe'] = array(
        'value' => 'Guadeloupe',
      );
      $return['guyane'] = array(
        'value' => 'Guyane',
      );
      $return['saint-barthelemy'] = array(
        'value' => 'Saint-Barthélémy',
      );
      $return['reunion'] = array(
        'value' => 'La Réunion',
      );
    }
    if ($country == "belgique") {
      $return['BE'] = array(
        'value' => 'Belgique',
      );
    }
    if ($country == "canada") {
      $return['QC'] = array(
        'value' => 'Québec',
      );
    }
    if ($country == "suisse") {
      $return['AG'] = array(
        'value' => 'Argovie',
      );
      $return['AI'] = array(
        'value' => 'Appenzell Rhodes-Intérieures',
      );
      $return['AR'] = array(
        'value' => 'Appenzell Rhodes-Extérieures',
      );
      $return['BE'] = array(
        'value' => 'Berne',
      );
      $return['BL'] = array(
        'value' => 'Bâle Campagne',
      );
      $return['BS'] = array(
        'value' => 'Bâle Ville',
      );
      $return['FR'] = array(
        'value' => 'Fribourg',
      );
      $return['GE'] = array(
        'value' => 'Genève',
      );
      $return['GL'] = array(
        'value' => 'Glaris',
      );
      $return['GR'] = array(
        'value' => 'Grisons',
      );
      $return['JU'] = array(
        'value' => 'Jura',
      );
      $return['LU'] = array(
        'value' => 'Lucerne',
      );
      $return['NE'] = array(
        'value' => 'Neuchâtel',
      );
      $return['NW'] = array(
        'value' => 'Nidwald',
      );
      $return['OW'] = array(
        'value' => 'Obwald',
      );
      $return['SG'] = array(
        'value' => 'Saint-Gall',
      );
      $return['SH'] = array(
        'value' => 'Scaffhouse',
      );
      $return['SO'] = array(
        'value' => 'Soleure',
      );
      $return['SZ'] = array(
        'value' => 'Schwytz',
      );
      $return['TG'] = array(
        'value' => 'Thurgovie',
      );
      $return['TI'] = array(
        'value' => 'Tessin',
      );
      $return['UR'] = array(
        'value' => 'Uri',
      );
      $return['VD'] = array(
        'value' => 'Vaud',
      );
      $return['VS'] = array(
        'value' => 'Valais',
      );
      $return['ZG'] = array(
        'value' => 'Zoug',
      );
      $return['ZH'] = array(
        'value' => 'Zurich',
      );
    }
    return $return;
  }

}

class dayinfoCmd extends cmd {
  public function execute($_options = null) {
  }

}

?>
