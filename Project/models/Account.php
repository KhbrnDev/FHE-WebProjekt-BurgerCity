<?php



namespace dwp\model;
use \dwp\core\Model as M;

class Account extends \dwp\core\Model
{
    const TABLENAME = 'Account';

    // TODO validation begrenzungen in den models fehlen
    protected $schema = [
        'accountId' => [ 'type' => M::TYPE_INTEGER ],
        'createdAt' => [ 'type' => M::TYPE_STRING],
        'updatedAt' => [ 'type' => M::TYPE_STRING],
        'email' => [ 'type' => M::TYPE_STRING, 'max' => 320 ],
        'passwordHash' => [ 'type' => M::TYPE_STRING, 'max' => 255 ],
        'birthday' => [ 'type' => M::TYPE_DATE ],
        'firstName' => [ 'type' => M::TYPE_STRING ],
        'lastName' => [ 'type' => M::TYPE_STRING ],
        'phoneNumber' => [ 'type' => M::TYPE_STRING ],
        'isAdmin' => [ 'type' => M::TYPE_BOOLEAN ],
        
    ];


    // METHODS
    // Validation
    public static function validateEmail($email, &$errors = [])
    {
        if($email === null)
        {
            $errors[] = 'Email fehlt.';
        }

        if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',$email))
        {
            $errors[] = 'EMail nicht valide.';
        }

        // added for pagesController.php -> checkout.php
        if(count($errors) === 0 )
        {
            return true;
        }
        
    }

    public static function validatePassword($password, &$errors = [])
    {
        if($password === null)
        {
            $errors[] = 'Kein Passwort angegeben';
        }
        
        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $password))
        {
            $errors[] = 'Password enthält nicht mindestens 1 Großbuchstaben, 1 Kleinbuchstaben und 1 Zahl oder hat weniger als 8 Zeichen.';
        }
    }

    public static function validatePhoneNumber($phonenumber, &$errors = [])
    {
        if($phonenumber === null)
            {
                $errors[] = 'Telefonnummer fehlt.';
            }

            if(!preg_match("/^[0-9]{6,}/", $phonenumber))
            {
                $errors[] = 'Telefonnummer muss mindestens 6 Zahlen und keine Buchstaben haben';
            }
    }

    public static function validateFirstName($firstname, &$errors = [])
    {
        if($firstname === null)
        {
            $errors[] = 'Vorname fehlt.';
        }

        if(strlen($firstname) < 2)
        {
            $errors[] = 'Vorname mindestens 2 Zeichen haben.';
        }

        if(!preg_match("/^[a-zA-Z-' 'ä'ü'ö'ß'Ä'Ü'Ö]*$/", $firstname))
        {
            $errors[] = 'Vornamen bitte mit Buchstaben a-z, ä, ü, ö in groß und kleinschreibung sowie ß, - ,  Leerzeichen angeben.';
        }
    }
    public static function validateLastName($lastname, &$errors = [])
    {
        if($lastname === null)
            {
                $errors[] = 'Nachname fehlt.';
            }

            if(strlen($lastname) < 2)
            {
                $errors[] = 'Nachname mindestens 2 Zeichen haben.';
            }

            if(!preg_match("/^[a-zA-Z-' 'ä'ü'ö'ß'Ä'Ü'Ö]*$/", $lastname))
            {
                $errors[] = 'Ihr Vor- oder Nachname bitte mit Buchstaben a-z, ä, ü, ö in groß und kleinschreibung sowie ß, - ,  Leerzeichen angeben.';
            }
    }

    public static function validateBirthday($birthday, &$errors)
    {
        if($birthday === null)
        {
            $errors [] = 'Geburtsdatum fehlt.';
        }
        
        if(!preg_match("/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/", $birthday))
        {
            $errors[] = "Bitte geben Sie ein gültiges Geburtsdatum an.";
        }
    }

    // depricated, but might be usefull later
    public static function makeDateForDB(&$date)
    {
        $date = date_create($date);
        $date = date_format($date, 'Y-m-d');

    }
    
}