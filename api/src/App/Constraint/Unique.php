<?php
namespace App\Constraint;

use Symfony\Component\Validator\Constraint;


class Unique extends Constraint
{
    /**
     * Message return when the field is not unique
     *
     * @var string
     */
    public $message = 'has already been used.';

    /**
     * Db instance
     *
     * @var mixed|null
     */
    public $db;

    /**
     * Table name to validate
     * @var
     */
    public $tableName;

    /**
     * Field to validate
     * @var
     */
    public $field;

    /**
     * Make the query where not row id
     * @var bool
     */
    public $rowId;

    public function __construct($db, $tableName, $field, $id = false)
    {
        $this->db = $db;
        $this->tableName = $tableName;
        $this->field = $field;
        $this->rowId = $id;
    }

    public function validatedBy()
    {
        return get_class($this) . 'Validator';

    }
}