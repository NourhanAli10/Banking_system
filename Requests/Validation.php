<?php

include_once 'config/Connection.php';
class Validation extends Connection
{
    private $inputValue;
    private $inputName;
    private array $errors = [];

    public function required(): self
    {
        if (empty($this->inputValue)) {
            $this->errors[$this->inputName][__FUNCTION__] = "{$this->inputName} is required";
        }
        return $this;
    }


    public function string(): self
    {
        if (!preg_match('/^[a-zA-Z]+$/', $this->inputValue)) {
            $this->errors[$this->inputName][__FUNCTION__] = "$this->inputName must be letters only";
        }
        return $this;
    }



    public function regex(): self
    {
        if (!preg_match(
            '/^[a-zA-Z][a-zA-Z0-9._%+-]*@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            $this->inputValue
        )) {
            $this->errors[$this->inputName][__FUNCTION__] = " {$this->inputName}
             is invalid ";
        }
        return $this;
    }


    public function numeric(): self
    {
        if (!is_numeric(filter_var($this->inputValue, FILTER_VALIDATE_INT))) {
            $this->errors[$this->inputName][__FUNCTION__] = " $this->inputName 
             must be numbers only";
        }
        return $this;
    }


    public function unique(): self
    {
        $query = "SELECT * FROM `customers` WHERE `email` = ?";
        $stmt = $this->con->prepare($query); // why not this con and only con 
        if (!$stmt) {
            $this->errors[$this->inputName][__FUNCTION__] = " something went wrong";
        }
        $stmt->bind_param('s', $this->inputValue);
        $stmt->execute();
        if ($stmt->get_result()->num_rows == 1) {
            $this->errors[$this->inputName][__FUNCTION__] = " {$this->inputName} 
            already exists";
        }
        return $this;
    }


    public function getError($inputName)
    {
        if (isset($this->errors[$inputName])) {
            return  reset($this->errors[$inputName]);
        }
    }


    /**
     * Set the value of inputValue
     *
     * @return  self
     */
    public function setInputValue($inputValue)
    {
        $this->inputValue = $inputValue;

        return $this;
    }

    /**
     * Set the value of inputName
     *
     * @return  self
     */
    public function setInputName($inputName)
    {
        $this->inputName = $inputName;

        return $this;
    }

    /**
     * Get the value of errors
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
