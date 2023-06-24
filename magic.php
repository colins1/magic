<?php

class PeopleList {
    private $people = array();

    public function addPerson($person) {
        $this->people[] = $person;
    }

    public function getPeople() {
        return $this->people;
    }
}

class Person
{
    public $name;
    public $login;
    public $other;

    public function __construct($name, $login, $other) {
        $this->name = $name;
        $this->login = $login;
        $this->other = $other;
    }

    public function __sleep() {
        return array('name', 'login');
    }

    public function getNameAndLogin() {
        echo "Выгрузка данных: '$this->name' и '$this->login' <br/>";
    }

    public function __get($name)
    {
        echo "Мы вызвали __get для '$name' <br/>";
    }

    public function __set($name, $value)
    {
        echo "Мы вызвали __set для '$name' с входными данными: $value<br/>";
    }

    public function __wakeup() 
    {
        echo "Object has been deserialized\n";
    }
}

$person = new Person('Максим', 'IlonMax', 'Умудрился написать нейросеть на ZX Spectrum 48K');
$person->seyHello;
$person->seyHello = 'Максим IlonMax';

$serializedObject = serialize($person);
print_r($serializedObject);
echo '<br/>';
// Почему при изменении размера вылезает ошибка? Notice: unserialize(): Error at offset 71 of 77 bytes on line 45
$serializedObject = str_replace('IlonMax', 'UlCoder', $serializedObject);
print_r($serializedObject);
echo '<br/>'; 
$myObject = unserialize($serializedObject);
echo '<br/>'; 
$myObject->getNameAndLogin();

$person2 = new Person('Никита', 'CoderSlowMo', 'Пишет в стиле СлоуМо, по началу было эфектно но устали ждать');

$list = new PeopleList();
$list->addPerson($person);
$list->addPerson($person2);

$people = $list->getPeople();

foreach ($people as $person) {
    echo ' Имя: ' . $person->name . ' Login: ' . $person->login . 'О сотруднике:' . $person->other . "<br/>";
}

?>
