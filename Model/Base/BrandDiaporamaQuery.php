<?php

namespace Diaporamas\Model\Base;

use \Exception;
use \PDO;
use Diaporamas\Model\BrandDiaporama as ChildBrandDiaporama;
use Diaporamas\Model\BrandDiaporamaI18nQuery as ChildBrandDiaporamaI18nQuery;
use Diaporamas\Model\BrandDiaporamaQuery as ChildBrandDiaporamaQuery;
use Diaporamas\Model\DiaporamaQuery as ChildDiaporamaQuery;
use Diaporamas\Model\Map\BrandDiaporamaTableMap;
use Diaporamas\Model\Thelia\Model\Brand;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'brand_diaporama' table.
 *
 *
 *
 * @method     ChildBrandDiaporamaQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     ChildBrandDiaporamaQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildBrandDiaporamaQuery orderByShortcode($order = Criteria::ASC) Order by the shortcode column
 *
 * @method     ChildBrandDiaporamaQuery groupByBrandId() Group by the brand_id column
 * @method     ChildBrandDiaporamaQuery groupById() Group by the id column
 * @method     ChildBrandDiaporamaQuery groupByShortcode() Group by the shortcode column
 *
 * @method     ChildBrandDiaporamaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBrandDiaporamaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBrandDiaporamaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBrandDiaporamaQuery leftJoinBrand($relationAlias = null) Adds a LEFT JOIN clause to the query using the Brand relation
 * @method     ChildBrandDiaporamaQuery rightJoinBrand($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Brand relation
 * @method     ChildBrandDiaporamaQuery innerJoinBrand($relationAlias = null) Adds a INNER JOIN clause to the query using the Brand relation
 *
 * @method     ChildBrandDiaporamaQuery leftJoinDiaporama($relationAlias = null) Adds a LEFT JOIN clause to the query using the Diaporama relation
 * @method     ChildBrandDiaporamaQuery rightJoinDiaporama($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Diaporama relation
 * @method     ChildBrandDiaporamaQuery innerJoinDiaporama($relationAlias = null) Adds a INNER JOIN clause to the query using the Diaporama relation
 *
 * @method     ChildBrandDiaporamaQuery leftJoinBrandDiaporamaI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandDiaporamaI18n relation
 * @method     ChildBrandDiaporamaQuery rightJoinBrandDiaporamaI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandDiaporamaI18n relation
 * @method     ChildBrandDiaporamaQuery innerJoinBrandDiaporamaI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandDiaporamaI18n relation
 *
 * @method     ChildBrandDiaporama findOne(ConnectionInterface $con = null) Return the first ChildBrandDiaporama matching the query
 * @method     ChildBrandDiaporama findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBrandDiaporama matching the query, or a new ChildBrandDiaporama object populated from the query conditions when no match is found
 *
 * @method     ChildBrandDiaporama findOneByBrandId(int $brand_id) Return the first ChildBrandDiaporama filtered by the brand_id column
 * @method     ChildBrandDiaporama findOneById(int $id) Return the first ChildBrandDiaporama filtered by the id column
 * @method     ChildBrandDiaporama findOneByShortcode(string $shortcode) Return the first ChildBrandDiaporama filtered by the shortcode column
 *
 * @method     array findByBrandId(int $brand_id) Return ChildBrandDiaporama objects filtered by the brand_id column
 * @method     array findById(int $id) Return ChildBrandDiaporama objects filtered by the id column
 * @method     array findByShortcode(string $shortcode) Return ChildBrandDiaporama objects filtered by the shortcode column
 *
 */
abstract class BrandDiaporamaQuery extends ChildDiaporamaQuery
{

    /**
     * Initializes internal state of \Diaporamas\Model\Base\BrandDiaporamaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\Diaporamas\\Model\\BrandDiaporama', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBrandDiaporamaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBrandDiaporamaQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \Diaporamas\Model\BrandDiaporamaQuery) {
            return $criteria;
        }
        $query = new \Diaporamas\Model\BrandDiaporamaQuery();
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
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildBrandDiaporama|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BrandDiaporamaTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BrandDiaporamaTableMap::DATABASE_NAME);
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
     * @return   ChildBrandDiaporama A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT BRAND_ID, ID, SHORTCODE FROM brand_diaporama WHERE ID = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            $obj = new ChildBrandDiaporama();
            $obj->hydrate($row);
            BrandDiaporamaTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildBrandDiaporama|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(12, 56, 832), $con);
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
     * @return ChildBrandDiaporamaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BrandDiaporamaTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildBrandDiaporamaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BrandDiaporamaTableMap::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the brand_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandId(1234); // WHERE brand_id = 1234
     * $query->filterByBrandId(array(12, 34)); // WHERE brand_id IN (12, 34)
     * $query->filterByBrandId(array('min' => 12)); // WHERE brand_id > 12
     * </code>
     *
     * @see       filterByBrand()
     *
     * @param     mixed $brandId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBrandDiaporamaQuery The current query, for fluid interface
     */
    public function filterByBrandId($brandId = null, $comparison = null)
    {
        if (is_array($brandId)) {
            $useMinMax = false;
            if (isset($brandId['min'])) {
                $this->addUsingAlias(BrandDiaporamaTableMap::BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(BrandDiaporamaTableMap::BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BrandDiaporamaTableMap::BRAND_ID, $brandId, $comparison);
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
     * @see       filterByDiaporama()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBrandDiaporamaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(BrandDiaporamaTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(BrandDiaporamaTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BrandDiaporamaTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the shortcode column
     *
     * Example usage:
     * <code>
     * $query->filterByShortcode('fooValue');   // WHERE shortcode = 'fooValue'
     * $query->filterByShortcode('%fooValue%'); // WHERE shortcode LIKE '%fooValue%'
     * </code>
     *
     * @param     string $shortcode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBrandDiaporamaQuery The current query, for fluid interface
     */
    public function filterByShortcode($shortcode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($shortcode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $shortcode)) {
                $shortcode = str_replace('*', '%', $shortcode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BrandDiaporamaTableMap::SHORTCODE, $shortcode, $comparison);
    }

    /**
     * Filter the query by a related \Diaporamas\Model\Thelia\Model\Brand object
     *
     * @param \Diaporamas\Model\Thelia\Model\Brand|ObjectCollection $brand The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBrandDiaporamaQuery The current query, for fluid interface
     */
    public function filterByBrand($brand, $comparison = null)
    {
        if ($brand instanceof \Diaporamas\Model\Thelia\Model\Brand) {
            return $this
                ->addUsingAlias(BrandDiaporamaTableMap::BRAND_ID, $brand->getId(), $comparison);
        } elseif ($brand instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BrandDiaporamaTableMap::BRAND_ID, $brand->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBrand() only accepts arguments of type \Diaporamas\Model\Thelia\Model\Brand or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Brand relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildBrandDiaporamaQuery The current query, for fluid interface
     */
    public function joinBrand($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Brand');

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
            $this->addJoinObject($join, 'Brand');
        }

        return $this;
    }

    /**
     * Use the Brand relation Brand object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\Thelia\Model\BrandQuery A secondary query class using the current class as primary query
     */
    public function useBrandQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBrand($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Brand', '\Diaporamas\Model\Thelia\Model\BrandQuery');
    }

    /**
     * Filter the query by a related \Diaporamas\Model\Diaporama object
     *
     * @param \Diaporamas\Model\Diaporama|ObjectCollection $diaporama The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBrandDiaporamaQuery The current query, for fluid interface
     */
    public function filterByDiaporama($diaporama, $comparison = null)
    {
        if ($diaporama instanceof \Diaporamas\Model\Diaporama) {
            return $this
                ->addUsingAlias(BrandDiaporamaTableMap::ID, $diaporama->getId(), $comparison);
        } elseif ($diaporama instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BrandDiaporamaTableMap::ID, $diaporama->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByDiaporama() only accepts arguments of type \Diaporamas\Model\Diaporama or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Diaporama relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildBrandDiaporamaQuery The current query, for fluid interface
     */
    public function joinDiaporama($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Diaporama');

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
            $this->addJoinObject($join, 'Diaporama');
        }

        return $this;
    }

    /**
     * Use the Diaporama relation Diaporama object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\DiaporamaQuery A secondary query class using the current class as primary query
     */
    public function useDiaporamaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDiaporama($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Diaporama', '\Diaporamas\Model\DiaporamaQuery');
    }

    /**
     * Filter the query by a related \Diaporamas\Model\BrandDiaporamaI18n object
     *
     * @param \Diaporamas\Model\BrandDiaporamaI18n|ObjectCollection $brandDiaporamaI18n  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBrandDiaporamaQuery The current query, for fluid interface
     */
    public function filterByBrandDiaporamaI18n($brandDiaporamaI18n, $comparison = null)
    {
        if ($brandDiaporamaI18n instanceof \Diaporamas\Model\BrandDiaporamaI18n) {
            return $this
                ->addUsingAlias(BrandDiaporamaTableMap::ID, $brandDiaporamaI18n->getId(), $comparison);
        } elseif ($brandDiaporamaI18n instanceof ObjectCollection) {
            return $this
                ->useBrandDiaporamaI18nQuery()
                ->filterByPrimaryKeys($brandDiaporamaI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBrandDiaporamaI18n() only accepts arguments of type \Diaporamas\Model\BrandDiaporamaI18n or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandDiaporamaI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildBrandDiaporamaQuery The current query, for fluid interface
     */
    public function joinBrandDiaporamaI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandDiaporamaI18n');

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
            $this->addJoinObject($join, 'BrandDiaporamaI18n');
        }

        return $this;
    }

    /**
     * Use the BrandDiaporamaI18n relation BrandDiaporamaI18n object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\BrandDiaporamaI18nQuery A secondary query class using the current class as primary query
     */
    public function useBrandDiaporamaI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinBrandDiaporamaI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandDiaporamaI18n', '\Diaporamas\Model\BrandDiaporamaI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBrandDiaporama $brandDiaporama Object to remove from the list of results
     *
     * @return ChildBrandDiaporamaQuery The current query, for fluid interface
     */
    public function prune($brandDiaporama = null)
    {
        if ($brandDiaporama) {
            $this->addUsingAlias(BrandDiaporamaTableMap::ID, $brandDiaporama->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the brand_diaporama table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandDiaporamaTableMap::DATABASE_NAME);
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
            BrandDiaporamaTableMap::clearInstancePool();
            BrandDiaporamaTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildBrandDiaporama or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildBrandDiaporama object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BrandDiaporamaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BrandDiaporamaTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        BrandDiaporamaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BrandDiaporamaTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildBrandDiaporamaQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'BrandDiaporamaI18n';

        return $this
            ->joinBrandDiaporamaI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildBrandDiaporamaQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'en_US', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('BrandDiaporamaI18n');
        $this->with['BrandDiaporamaI18n']->setIsWithOneToMany(false);

        return $this;
    }

    /**
     * Use the I18n relation query object
     *
     * @see       useQuery()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildBrandDiaporamaI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandDiaporamaI18n', '\Diaporamas\Model\BrandDiaporamaI18nQuery');
    }

} // BrandDiaporamaQuery
