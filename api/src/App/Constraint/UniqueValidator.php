<?php
namespace App\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Unique validation in DB fields
 *
 * Class UniqueValidator
 * @package App\Constraint
 */
class UniqueValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $query = $constraint->db->createQueryBuilder();
        $query->select('count(e.id) as count')
            ->from($constraint->tableName, 'e')
            ->where("e.{$constraint->field}  = '" . trim($value)."'");



        if ($constraint->rowId) {
            $query->andWhere('e.id  !=' . $query->createNamedParameter($constraint->rowId));
        }
        $result = $query->execute()->fetch();
        if ((bool)array_get($result,'count',0) !== false) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
            return false;
        }
        return true;
    }

}