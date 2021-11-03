<?php

class UNE
{
    protected $i;
    protected $tmp;

    public $list;
    public $table;
    public $read1;
    public $read2;
    public $kws;
    public $cost;

    public function __construct()
    {
        $this->list = [
            [ "in"=> 1,   "out"=> 100,  "cost"=> 0.09 ],
            [ "in"=> 101, "out"=> 150,  "cost"=> 0.30 ],
            [ "in"=> 151, "out"=> 200,  "cost"=> 0.40 ],
            [ "in"=> 201, "out"=> 250,  "cost"=> 0.60 ],
            [ "in"=> 251, "out"=> 300,  "cost"=> 0.80 ],
            [ "in"=> 301, "out"=> 350,  "cost"=> 1.50 ],
            [ "in"=> 351, "out"=> 500,  "cost"=> 1.80 ],
            [ "in"=> 501, "out"=> 1000, "cost"=> 2.00 ],
            [ "in"=> 1001, "out"=> 5000, "cost"=> 3.00 ],
            [ "in"=> 5001, "out"=> 100000000, "cost"=> 5.00 ],
        ];

        $this->set();
    }


    public function set($read1=0, $read2=0){
        $this->read1 = $read1;
        $this->read2 = $read2;
        $this->reset();
        return $this;
    }

    public function reset($kwh=0){
        $this->kws = $kwh==0 ? $this->read2 - $this->read1 : $kwh;
        $this->cost = 0;
        $this->table = [];
    }

    public function process($kwh=0){
        $this->reset($kwh);
        $this->tmp = $this->kws;
        $i = 0;
        while ($this->tmp > 0){
            $this->calculate($i);
            $i++;
        }
        return $this;
    }

    public function calculate($i){
        $price = $this->getPrice($i);
        if($this->tmp > $price){
            $this->tmp -= $price;
            $kwt  = $price;
        }else{
            $kwt  = $this->tmp;
            $this->tmp = 0;
        }

        $cost = $kwt * $this->list[$i]['cost'];
        $this->table[] = [ "kwh"=>$kwt, "price"=>$this->list[$i]['cost'], "cost"=>$cost, "rest"=>$this->tmp ];
        $this->cost += $cost; 
    } 

    public function getPrice($i){
        return $this->list[$i]['out'] - $this->list[$i]['in'] + 1;;
    }
}

