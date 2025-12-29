<?php
require_once 'database.php';
interface Calculable{
    public function statistic($conn);            
}