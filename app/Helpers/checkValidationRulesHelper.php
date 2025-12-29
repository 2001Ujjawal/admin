<?php

namespace App\Helpers;

class checkValidationRulesHelper
{
    public static function validateData(string $ruleGroup, array $data)
    {
        $validation = \Config\Services::validation();
        $validation->setRuleGroup($ruleGroup);
        if (!$validation->run($data)) {
            $errors = $validation->getErrors();
            $firstError = reset($errors);
            return [
                'status' => false,
                'first_error' => $firstError,
                
                'errors' => $errors,
            ];
        }
        return ['status' => true];
    }
}
