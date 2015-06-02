<?php

namespace Diaporamas\Model\Base;

use \Exception;
use \PDO;
use Diaporamas\Model\DiaporamaImage as ChildDiaporamaImage;
use Diaporamas\Model\DiaporamaImageQuery as ChildDiaporamaImageQuery;
use Diaporamas\Model\Map\DiaporamaImageTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'diaporama_image' table.
 *
 *
 *
 * @method     ChildDiaporamaImageQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildDiaporamaImageQuery orderByDiaporamaId($order = Criteria::ASC) Order by the diaporama_id column
 * @method     ChildDiaporamaImageQuery orderByPosition($order = Criteria::ASC) Order by the position column
 * @method     ChildDiaporamaImageQuery orderByDescendantClass($order = Criteria::ASC) Order by the descendant_class column
 *
 * @method     ChildDiaporamaImageQuery groupById() Group by the id column
 * @method     ChildDiaporamaImageQuery groupByDiaporamaId() Group by the diaporama_id column
 * @method     ChildDiaporamaImageQuery groupByPosition() Group by the position column
 * @method     ChildDiaporamaImageQuery groupByDescendantClass() Group by the descendant_class column
 *
 * @method     ChildDiaporamaImageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDiaporamaImageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDiaporamaImageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDiaporamaImageQuery leftJoinDiaporama($relationAlias = null) Adds a LEFT JOIN clause to the query using the Diaporama relation
 * @method     ChildDiaporamaImageQuery rightJoinDiaporama($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Diaporama relation
 * @method     ChildDiaporamaImageQuery innerJoinDiaporama($relationAlias = null) Adds a INNER JOIN clause to the query using the Diaporama relation
 *
 * @method     ChildDiaporamaImageQuery leftJoinProductDiaporamaImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductDiaporamaImage relation
 * @method     ChildDiaporamaImageQuery rightJoinProductDiaporamaImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductDiaporamaImage relation
 * @method     ChildDiaporamaImageQuery innerJoinProductDiaporamaImage($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductDiaporamaImage relation
 *
 * @method     ChildDiaporamaImageQuery leftJoinCategoryDiaporamaImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the CategoryDiaporamaImage relation
 * @method     ChildDiaporamaImageQuery rightJoinCategoryDiaporamaImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CategoryDiaporamaImage relation
 * @method     ChildDiaporamaImageQuery innerJoinCategoryDiaporamaImage($relationAlias = null) Adds a INNER JOIN clause to the query using the CategoryDiaporamaImage relation
 *
 * @method     ChildDiaporamaImageQuery leftJoinBrandDiaporamaImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandDiaporamaImage relation
 * @method     ChildDiaporamaImageQuery rightJoinBrandDiaporamaImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandDiaporamaImage relation
 * @method     ChildDiaporamaImageQuery innerJoinBrandDiaporamaImage($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandDiaporamaImage relation
 *
 * @method     ChildDiaporamaImageQuery leftJoinFolderDiaporamaImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the FolderDiaporamaImage relation
 * @method     ChildDiaporamaImageQuery rightJoinFolderDiaporamaImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FolderDiaporamaImage relation
 * @method     ChildDiaporamaImageQuery innerJoinFolderDiaporamaImage($relationAlias = null) Adds a INNER JOIN clause to the query using the FolderDiaporamaImage relation
 *
 * @method     ChildDiaporamaImageQuery leftJoinContentDiaporamaImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the ContentDiaporamaImage relation
 * @method     ChildDiaporamaImageQuery rightJoinContentDiaporamaImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ContentDiaporamaImage relation
 * @method     ChildDiaporamaImageQuery innerJoinContentDiaporamaImage($relationAlias = null) Adds a INNER JOIN clause to the query using the ContentDiaporamaImage relation
 *
 * @method     ChildDiaporamaImage findOne(ConnectionInterface $con = null) Return the first ChildDiaporamaImage matching the query
 * @method     ChildDiaporamaImage findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDiaporamaImage matching the query, or a new ChildDiaporamaImage object populated from the query conditions when no match is found
 *
 * @method     ChildDiaporamaImage findOneById(int $id) Return the first ChildDiaporamaImage filtered by the id column
 * @method     ChildDiaporamaImage findOneByDiaporamaId(int $diaporama_id) Return the first ChildDiaporamaImage filtered by the diaporama_id column
 * @method     ChildDiaporamaImage findOneByPosition(int $position) Return the first ChildDiaporamaImage filtered by the position column
 * @method     ChildDiaporamaImage findOneByDescendantClass(string $descendant_class) Return the first ChildDiaporamaImage filtered by the descendant_class column
 *
 * @method     array findById(int $id) Return ChildDiaporamaImage objects filtered by the id column
 * @method     array findByDiaporamaId(int $diaporama_id) Return ChildDiaporamaImage objects filtered by the diaporama_id column
 * @method     array findByPosition(int $position) Return ChildDiaporamaImage objects filtered by the position column
 * @method     array findByDescendantClass(string $descendant_class) Return ChildDiaporamaImage objects filtered by the descendant_class column
 *
 */
abstract class DiaporamaImageQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \Diaporamas\Model\Base\DiaporamaImageQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\Diaporamas\\Model\\DiaporamaImage', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDiaporamaImageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDiaporamaImageQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \Diaporamas\Model\DiaporamaImageQuery) {
            return $criteria;
        }
        $query = new \Diaporamas\Model\DiaporamaImageQuery();
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
     * @return ChildDiaporamaImage|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DiaporamaImageTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DiaporamaImageTableMap::DATABASE_NAME);
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
     * @return   ChildDiaporamaImage A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, DIAPORAMA_ID, POSITION, DESCENDANT_CLASS FROM diaporama_image WHERE ID = :p0';
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
            $obj = new ChildDiaporamaImage();
            $obj->hydrate($row);
            DiaporamaImageTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildDiaporamaImage|array|mixed the result, formatted by the current formatter
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
     * @return ChildDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DiaporamaImageTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DiaporamaImageTableMap::ID, $keys, Criteria::IN);
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
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(DiaporamaImageTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(DiaporamaImageTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DiaporamaImageTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the diaporama_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDiaporamaId(1234); // WHERE diaporama_id = 1234
     * $query->filterByDiaporamaId(array(12, 34)); // WHERE diaporama_id IN (12, 34)
     * $query->filterByDiaporamaId(array('min' => 12)); // WHERE diaporama_id > 12
     * </code>
     *
     * @see       filterByDiaporama()
     *
     * @param     mixed $diaporamaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByDiaporamaId($diaporamaId = null, $comparison = null)
    {
        if (is_array($diaporamaId)) {
            $useMinMax = false;
            if (isset($diaporamaId['min'])) {
                $this->addUsingAlias(DiaporamaImageTableMap::DIAPORAMA_ID, $diaporamaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($diaporamaId['max'])) {
                $this->addUsingAlias(DiaporamaImageTableMap::DIAPORAMA_ID, $diaporamaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DiaporamaImageTableMap::DIAPORAMA_ID, $diaporamaId, $comparison);
    }

    /**
     * Filter the query on the position column
     *
     * Example usage:
     * <code>
     * $query->filterByPosition(1234); // WHERE position = 1234
     * $query->filterByPosition(array(12, 34)); // WHERE position IN (12, 34)
     * $query->filterByPosition(array('min' => 12)); // WHERE position > 12
     * </code>
     *
     * @param     mixed $position The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByPosition($position = null, $comparison = null)
    {
        if (is_array($position)) {
            $useMinMax = false;
            if (isset($position['min'])) {
                $this->addUsingAlias(DiaporamaImageTableMap::POSITION, $position['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($position['max'])) {
                $this->addUsingAlias(DiaporamaImageTableMap::POSITION, $position['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DiaporamaImageTableMap::POSITION, $position, $comparison);
    }

    /**
     * Filter the query on the descendant_class column
     *
     * Example usage:
     * <code>
     * $query->filterByDescendantClass('fooValue');   // WHERE descendant_class = 'fooValue'
     * $query->filterByDescendantClass('%fooValue%'); // WHERE descendant_class LIKE '%fooValue%'
     * </code>
     *
     * @param     string $descendantClass The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByDescendantClass($descendantClass = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descendantClass)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $descendantClass)) {
                $descendantClass = str_replace('*', '%', $descendantClass);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DiaporamaImageTableMap::DESCENDANT_CLASS, $descendantClass, $comparison);
    }

    /**
     * Filter the query by a related \Diaporamas\Model\Diaporama object
     *
     * @param \Diaporamas\Model\Diaporama|ObjectCollection $diaporama The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByDiaporama($diaporama, $comparison = null)
    {
        if ($diaporama instanceof \Diaporamas\Model\Diaporama) {
            return $this
                ->addUsingAlias(DiaporamaImageTableMap::DIAPORAMA_ID, $diaporama->getId(), $comparison);
        } elseif ($diaporama instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DiaporamaImageTableMap::DIAPORAMA_ID, $diaporama->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ChildDiaporamaImageQuery The current query, for fluid interface
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
     * Filter the query by a related \Diaporamas\Model\ProductDiaporamaImage object
     *
     * @param \Diaporamas\Model\ProductDiaporamaImage|ObjectCollection $productDiaporamaImage  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByProductDiaporamaImage($productDiaporamaImage, $comparison = null)
    {
        if ($productDiaporamaImage instanceof \Diaporamas\Model\ProductDiaporamaImage) {
            return $this
                ->addUsingAlias(DiaporamaImageTableMap::ID, $productDiaporamaImage->getId(), $comparison);
        } elseif ($productDiaporamaImage instanceof ObjectCollection) {
            return $this
                ->useProductDiaporamaImageQuery()
                ->filterByPrimaryKeys($productDiaporamaImage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductDiaporamaImage() only accepts arguments of type \Diaporamas\Model\ProductDiaporamaImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductDiaporamaImage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildDiaporamaImageQuery The current query, for fluid interface
     */
    public function joinProductDiaporamaImage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductDiaporamaImage');

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
            $this->addJoinObject($join, 'ProductDiaporamaImage');
        }

        return $this;
    }

    /**
     * Use the ProductDiaporamaImage relation ProductDiaporamaImage object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\ProductDiaporamaImageQuery A secondary query class using the current class as primary query
     */
    public function useProductDiaporamaImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductDiaporamaImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductDiaporamaImage', '\Diaporamas\Model\ProductDiaporamaImageQuery');
    }

    /**
     * Filter the query by a related \Diaporamas\Model\CategoryDiaporamaImage object
     *
     * @param \Diaporamas\Model\CategoryDiaporamaImage|ObjectCollection $categoryDiaporamaImage  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByCategoryDiaporamaImage($categoryDiaporamaImage, $comparison = null)
    {
        if ($categoryDiaporamaImage instanceof \Diaporamas\Model\CategoryDiaporamaImage) {
            return $this
                ->addUsingAlias(DiaporamaImageTableMap::ID, $categoryDiaporamaImage->getId(), $comparison);
        } elseif ($categoryDiaporamaImage instanceof ObjectCollection) {
            return $this
                ->useCategoryDiaporamaImageQuery()
                ->filterByPrimaryKeys($categoryDiaporamaImage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCategoryDiaporamaImage() only accepts arguments of type \Diaporamas\Model\CategoryDiaporamaImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CategoryDiaporamaImage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildDiaporamaImageQuery The current query, for fluid interface
     */
    public function joinCategoryDiaporamaImage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CategoryDiaporamaImage');

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
            $this->addJoinObject($join, 'CategoryDiaporamaImage');
        }

        return $this;
    }

    /**
     * Use the CategoryDiaporamaImage relation CategoryDiaporamaImage object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\CategoryDiaporamaImageQuery A secondary query class using the current class as primary query
     */
    public function useCategoryDiaporamaImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategoryDiaporamaImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CategoryDiaporamaImage', '\Diaporamas\Model\CategoryDiaporamaImageQuery');
    }

    /**
     * Filter the query by a related \Diaporamas\Model\BrandDiaporamaImage object
     *
     * @param \Diaporamas\Model\BrandDiaporamaImage|ObjectCollection $brandDiaporamaImage  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByBrandDiaporamaImage($brandDiaporamaImage, $comparison = null)
    {
        if ($brandDiaporamaImage instanceof \Diaporamas\Model\BrandDiaporamaImage) {
            return $this
                ->addUsingAlias(DiaporamaImageTableMap::ID, $brandDiaporamaImage->getId(), $comparison);
        } elseif ($brandDiaporamaImage instanceof ObjectCollection) {
            return $this
                ->useBrandDiaporamaImageQuery()
                ->filterByPrimaryKeys($brandDiaporamaImage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBrandDiaporamaImage() only accepts arguments of type \Diaporamas\Model\BrandDiaporamaImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandDiaporamaImage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildDiaporamaImageQuery The current query, for fluid interface
     */
    public function joinBrandDiaporamaImage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandDiaporamaImage');

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
            $this->addJoinObject($join, 'BrandDiaporamaImage');
        }

        return $this;
    }

    /**
     * Use the BrandDiaporamaImage relation BrandDiaporamaImage object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\BrandDiaporamaImageQuery A secondary query class using the current class as primary query
     */
    public function useBrandDiaporamaImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBrandDiaporamaImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandDiaporamaImage', '\Diaporamas\Model\BrandDiaporamaImageQuery');
    }

    /**
     * Filter the query by a related \Diaporamas\Model\FolderDiaporamaImage object
     *
     * @param \Diaporamas\Model\FolderDiaporamaImage|ObjectCollection $folderDiaporamaImage  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByFolderDiaporamaImage($folderDiaporamaImage, $comparison = null)
    {
        if ($folderDiaporamaImage instanceof \Diaporamas\Model\FolderDiaporamaImage) {
            return $this
                ->addUsingAlias(DiaporamaImageTableMap::ID, $folderDiaporamaImage->getId(), $comparison);
        } elseif ($folderDiaporamaImage instanceof ObjectCollection) {
            return $this
                ->useFolderDiaporamaImageQuery()
                ->filterByPrimaryKeys($folderDiaporamaImage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFolderDiaporamaImage() only accepts arguments of type \Diaporamas\Model\FolderDiaporamaImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FolderDiaporamaImage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildDiaporamaImageQuery The current query, for fluid interface
     */
    public function joinFolderDiaporamaImage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FolderDiaporamaImage');

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
            $this->addJoinObject($join, 'FolderDiaporamaImage');
        }

        return $this;
    }

    /**
     * Use the FolderDiaporamaImage relation FolderDiaporamaImage object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\FolderDiaporamaImageQuery A secondary query class using the current class as primary query
     */
    public function useFolderDiaporamaImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFolderDiaporamaImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FolderDiaporamaImage', '\Diaporamas\Model\FolderDiaporamaImageQuery');
    }

    /**
     * Filter the query by a related \Diaporamas\Model\ContentDiaporamaImage object
     *
     * @param \Diaporamas\Model\ContentDiaporamaImage|ObjectCollection $contentDiaporamaImage  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByContentDiaporamaImage($contentDiaporamaImage, $comparison = null)
    {
        if ($contentDiaporamaImage instanceof \Diaporamas\Model\ContentDiaporamaImage) {
            return $this
                ->addUsingAlias(DiaporamaImageTableMap::ID, $contentDiaporamaImage->getId(), $comparison);
        } elseif ($contentDiaporamaImage instanceof ObjectCollection) {
            return $this
                ->useContentDiaporamaImageQuery()
                ->filterByPrimaryKeys($contentDiaporamaImage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByContentDiaporamaImage() only accepts arguments of type \Diaporamas\Model\ContentDiaporamaImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ContentDiaporamaImage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildDiaporamaImageQuery The current query, for fluid interface
     */
    public function joinContentDiaporamaImage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ContentDiaporamaImage');

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
            $this->addJoinObject($join, 'ContentDiaporamaImage');
        }

        return $this;
    }

    /**
     * Use the ContentDiaporamaImage relation ContentDiaporamaImage object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\ContentDiaporamaImageQuery A secondary query class using the current class as primary query
     */
    public function useContentDiaporamaImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinContentDiaporamaImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ContentDiaporamaImage', '\Diaporamas\Model\ContentDiaporamaImageQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildDiaporamaImage $diaporamaImage Object to remove from the list of results
     *
     * @return ChildDiaporamaImageQuery The current query, for fluid interface
     */
    public function prune($diaporamaImage = null)
    {
        if ($diaporamaImage) {
            $this->addUsingAlias(DiaporamaImageTableMap::ID, $diaporamaImage->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the diaporama_image table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DiaporamaImageTableMap::DATABASE_NAME);
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
            DiaporamaImageTableMap::clearInstancePool();
            DiaporamaImageTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildDiaporamaImage or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildDiaporamaImage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DiaporamaImageTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DiaporamaImageTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        DiaporamaImageTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DiaporamaImageTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

} // DiaporamaImageQuery
