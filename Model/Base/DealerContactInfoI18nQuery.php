<?php

namespace Dealer\Model\Base;

use \Exception;
use \PDO;
use Dealer\Model\DealerContactInfoI18n as ChildDealerContactInfoI18n;
use Dealer\Model\DealerContactInfoI18nQuery as ChildDealerContactInfoI18nQuery;
use Dealer\Model\Map\DealerContactInfoI18nTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'dealer_contact_info_i18n' table.
 *
 *
 *
 * @method     ChildDealerContactInfoI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildDealerContactInfoI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method     ChildDealerContactInfoI18nQuery orderByValue($order = Criteria::ASC) Order by the value column
 *
 * @method     ChildDealerContactInfoI18nQuery groupById() Group by the id column
 * @method     ChildDealerContactInfoI18nQuery groupByLocale() Group by the locale column
 * @method     ChildDealerContactInfoI18nQuery groupByValue() Group by the value column
 *
 * @method     ChildDealerContactInfoI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDealerContactInfoI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDealerContactInfoI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDealerContactInfoI18nQuery leftJoinDealerContactInfo($relationAlias = null) Adds a LEFT JOIN clause to the query using the DealerContactInfo relation
 * @method     ChildDealerContactInfoI18nQuery rightJoinDealerContactInfo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DealerContactInfo relation
 * @method     ChildDealerContactInfoI18nQuery innerJoinDealerContactInfo($relationAlias = null) Adds a INNER JOIN clause to the query using the DealerContactInfo relation
 *
 * @method     ChildDealerContactInfoI18n findOne(ConnectionInterface $con = null) Return the first ChildDealerContactInfoI18n matching the query
 * @method     ChildDealerContactInfoI18n findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDealerContactInfoI18n matching the query, or a new ChildDealerContactInfoI18n object populated from the query conditions when no match is found
 *
 * @method     ChildDealerContactInfoI18n findOneById(int $id) Return the first ChildDealerContactInfoI18n filtered by the id column
 * @method     ChildDealerContactInfoI18n findOneByLocale(string $locale) Return the first ChildDealerContactInfoI18n filtered by the locale column
 * @method     ChildDealerContactInfoI18n findOneByValue(string $value) Return the first ChildDealerContactInfoI18n filtered by the value column
 *
 * @method     array findById(int $id) Return ChildDealerContactInfoI18n objects filtered by the id column
 * @method     array findByLocale(string $locale) Return ChildDealerContactInfoI18n objects filtered by the locale column
 * @method     array findByValue(string $value) Return ChildDealerContactInfoI18n objects filtered by the value column
 *
 */
abstract class DealerContactInfoI18nQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \Dealer\Model\Base\DealerContactInfoI18nQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\Dealer\\Model\\DealerContactInfoI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDealerContactInfoI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDealerContactInfoI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \Dealer\Model\DealerContactInfoI18nQuery) {
            return $criteria;
        }
        $query = new \Dealer\Model\DealerContactInfoI18nQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id, $locale] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildDealerContactInfoI18n|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DealerContactInfoI18nTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DealerContactInfoI18nTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return   ChildDealerContactInfoI18n A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, LOCALE, VALUE FROM dealer_contact_info_i18n WHERE ID = :p0 AND LOCALE = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            $obj = new ChildDealerContactInfoI18n();
            $obj->hydrate($row);
            DealerContactInfoI18nTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildDealerContactInfoI18n|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return ChildDealerContactInfoI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(DealerContactInfoI18nTableMap::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(DealerContactInfoI18nTableMap::LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildDealerContactInfoI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(DealerContactInfoI18nTableMap::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(DealerContactInfoI18nTableMap::LOCALE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @see       filterByDealerContactInfo()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDealerContactInfoI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(DealerContactInfoI18nTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(DealerContactInfoI18nTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DealerContactInfoI18nTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the locale column
     *
     * Example usage:
     * <code>
     * $query->filterByLocale('fooValue');   // WHERE locale = 'fooValue'
     * $query->filterByLocale('%fooValue%'); // WHERE locale LIKE '%fooValue%'
     * </code>
     *
     * @param     string $locale The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDealerContactInfoI18nQuery The current query, for fluid interface
     */
    public function filterByLocale($locale = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($locale)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $locale)) {
                $locale = str_replace('*', '%', $locale);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DealerContactInfoI18nTableMap::LOCALE, $locale, $comparison);
    }

    /**
     * Filter the query on the value column
     *
     * Example usage:
     * <code>
     * $query->filterByValue('fooValue');   // WHERE value = 'fooValue'
     * $query->filterByValue('%fooValue%'); // WHERE value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $value The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDealerContactInfoI18nQuery The current query, for fluid interface
     */
    public function filterByValue($value = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($value)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $value)) {
                $value = str_replace('*', '%', $value);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DealerContactInfoI18nTableMap::VALUE, $value, $comparison);
    }

    /**
     * Filter the query by a related \Dealer\Model\DealerContactInfo object
     *
     * @param \Dealer\Model\DealerContactInfo|ObjectCollection $dealerContactInfo The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDealerContactInfoI18nQuery The current query, for fluid interface
     */
    public function filterByDealerContactInfo($dealerContactInfo, $comparison = null)
    {
        if ($dealerContactInfo instanceof \Dealer\Model\DealerContactInfo) {
            return $this
                ->addUsingAlias(DealerContactInfoI18nTableMap::ID, $dealerContactInfo->getId(), $comparison);
        } elseif ($dealerContactInfo instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DealerContactInfoI18nTableMap::ID, $dealerContactInfo->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByDealerContactInfo() only accepts arguments of type \Dealer\Model\DealerContactInfo or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DealerContactInfo relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildDealerContactInfoI18nQuery The current query, for fluid interface
     */
    public function joinDealerContactInfo($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DealerContactInfo');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'DealerContactInfo');
        }

        return $this;
    }

    /**
     * Use the DealerContactInfo relation DealerContactInfo object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Dealer\Model\DealerContactInfoQuery A secondary query class using the current class as primary query
     */
    public function useDealerContactInfoQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinDealerContactInfo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DealerContactInfo', '\Dealer\Model\DealerContactInfoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildDealerContactInfoI18n $dealerContactInfoI18n Object to remove from the list of results
     *
     * @return ChildDealerContactInfoI18nQuery The current query, for fluid interface
     */
    public function prune($dealerContactInfoI18n = null)
    {
        if ($dealerContactInfoI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(DealerContactInfoI18nTableMap::ID), $dealerContactInfoI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(DealerContactInfoI18nTableMap::LOCALE), $dealerContactInfoI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the dealer_contact_info_i18n table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DealerContactInfoI18nTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DealerContactInfoI18nTableMap::clearInstancePool();
            DealerContactInfoI18nTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildDealerContactInfoI18n or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildDealerContactInfoI18n object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DealerContactInfoI18nTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DealerContactInfoI18nTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        DealerContactInfoI18nTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DealerContactInfoI18nTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

} // DealerContactInfoI18nQuery
