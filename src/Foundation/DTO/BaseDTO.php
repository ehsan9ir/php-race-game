<?php

namespace Foundation\DTO;

class BaseDTO
{
    // Use a unique value as a sentinel
    protected const SENTINEL = '__null_sentinel__';

    protected const EMPTY_STRING = '';

    /**
     * This should be overridden in any child class
     * to include all database columns of the respective table
     */
    const COLUMNS = [];

    public function __construct()
    {
        /**
         * differentiates between passing null and not passing
         * anything at all so sentinel will be passed and the returned
         * values of persistable method will not include it when
         * persisting in datastructures
         */
        foreach (self::COLUMNS as $column) {
            $this->setPersistableNull($column, $this->$column);
        }
    }

    /**
     * use this to create eloquent model(persist on database) but don't use in this project
     * out of DTO
     *
     * @return array
     */
    public function persistable(): array
    {
        $persistable = [];
        foreach (static::COLUMNS as $column) {
            if ($this->$column !== self::SENTINEL) {
                $persistable[$column] = $this->$column;
            }
        }

        return $persistable;
    }

    /**
     * --------------- Protected Methods -----------------
     */

    protected function setPersistableNull(string $property, mixed $value): void
    {
        if ($this->$property !== self::SENTINEL) {
            $this->$property = $value;
        }
    }
}
