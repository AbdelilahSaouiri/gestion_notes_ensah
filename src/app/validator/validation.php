<?php

namespace src\app\validattor;

class Validator
{

    function validateData($data)
    {
        $errors = [];

        if (empty($data['cin'])) {
            $errors['empty_cin'] = "CIN is required";
        }

        if (empty($data['nom'])) {
            $errors['empty_nom'] = "Nom is required";
        }

        if (empty($data['prenom'])) {
            $errors['empty_prenom'] = "Prénom is required";
        }

        if (empty($data['email'])) {
            $errors['empty_email'] = "Email is required";
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['invalid_email'] = "Invalid email format";
        }

        if (empty($data['departement'])) {
            $errors['empty_departement'] = "Département is required";
        }

        if (empty($data['type_prof'])) {
            $errors['empty_type_prof'] = "Type de professeur is required";
        }

        if (empty($data['filiere'])) {
            $errors['empty_filiere'] = "Filière is required";
        }
        return $errors;
    }
}
