<?php

namespace Diaporamas\Model\Map;

use Diaporamas\Model\Diaporama;
use Diaporamas\Model\DiaporamaQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'diaporama' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class DiaporamaTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;
    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Diaporamas.Model.Map.DiaporamaTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'thelia';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'diaporama';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Diaporamas\\Model\\Diaporama';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Diaporamas.Model.Diaporama';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 3;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 3;

    /**
     * the column name for the ID field
     */
    const ID = 'diaporama.ID';

    /**
     * the column name for the SHORTCODE field
     */
    const SHORTCODE = 'diaporama.SHORTCODE';

    /**
     * the column name for the DESCENDANT_CLASS field
     */
    const DESCENDANT_CLASS = 'diaporama.DESCENDANT_CLASS';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    // i18n behavior

    /**
     * The default locale to use for translations.
     *
     * @var string
     */
    const DEFAULT_LOCALE = 'en_US';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Shortcode', 'DescendantClass', ),
        self::TYPE_STUDLYPHPNAME => array('id', 'shortcode', 'descendantClass', ),
        self::TYPE_COLNAME       => array(DiaporamaTableMap::ID, DiaporamaTableMap::SHORTCODE, DiaporamaTableMap::DESCENDANT_CLASS, ),
        self::TYPE_RAW_COLNAME   => array('ID', 'SHORTCODE', 'DESCENDANT_CLASS', ),
        self::TYPE_FIELDNAME     => array('id', 'shortcode', 'descendant_class', ),
        self::TYPE_NUM           => array(0, 1, 2, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Shortcode' => 1, 'DescendantClass' => 2, ),
        self::TYPE_STUDLYPHPNAME => array('id' => 0, 'shortcode' => 1, 'descendantClass' => 2, ),
        self::TYPE_COLNAME       => array(DiaporamaTableMap::ID => 0, DiaporamaTableMap::SHORTCODE => 1, DiaporamaTableMap::DESCENDANT_CLASS => 2, ),
        self::TYPE_RAW_COLNAME   => array('ID' => 0, 'SHORTCODE' => 1, 'DESCENDANT_CLASS' => 2, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'shortcode' => 1, 'descendant_class' => 2, ),
        self::TYPE_NUM           => array(0, 1, 2, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('diaporama');
        $this->setPhpName('Diaporama');
        $this->setClassName('\\Diaporamas\\Model\\Diaporama');
        $this->setPackage('Diaporamas.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('SHORTCODE', 'Shortcode', 'VARCHAR', true, 32, null);
        $this->addColumn('DESCENDANT_CLASS', 'DescendantClass', 'VARCHAR', false, 100, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('DiaporamaImage', '\\Diaporamas\\Model\\DiaporamaImage', RelationMap::ONE_TO_MANY, array('id' => 'diaporama_id', ), null, null, 'DiaporamaImages');
        $this->addRelation('ProductDiaporama', '\\Diaporamas\\Model\\ProductDiaporama', RelationMap::ONE_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
        $this->addRelation('CategoryDiaporama', '\\Diaporamas\\Model\\CategoryDiaporama', RelationMap::ONE_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
        $this->addRelation('BrandDiaporama', '\\Diaporamas\\Model\\BrandDiaporama', RelationMap::ONE_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
        $this->addRelation('FolderDiaporama', '\\Diaporamas\\Model\\FolderDiaporama', RelationMap::ONE_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
        $this->addRelation('ContentDiaporama', '\\Diaporamas\\Model\\ContentDiaporama', RelationMap::ONE_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
        $this->addRelation('ProductDiaporamaImage', '\\Diaporamas\\Model\\ProductDiaporamaImage', RelationMap::ONE_TO_MANY, array('id' => 'diaporama_id', ), null, null, 'ProductDiaporamaImages');
        $this->addRelation('CategoryDiaporamaImage', '\\Diaporamas\\Model\\CategoryDiaporamaImage', RelationMap::ONE_TO_MANY, array('id' => 'diaporama_id', ), null, null, 'CategoryDiaporamaImages');
        $this->addRelation('BrandDiaporamaImage', '\\Diaporamas\\Model\\BrandDiaporamaImage', RelationMap::ONE_TO_MANY, array('id' => 'diaporama_id', ), null, null, 'BrandDiaporamaImages');
        $this->addRelation('FolderDiaporamaImage', '\\Diaporamas\\Model\\FolderDiaporamaImage', RelationMap::ONE_TO_MANY, array('id' => 'diaporama_id', ), null, null, 'FolderDiaporamaImages');
        $this->addRelation('ContentDiaporamaImage', '\\Diaporamas\\Model\\ContentDiaporamaImage', RelationMap::ONE_TO_MANY, array('id' => 'diaporama_id', ), null, null, 'ContentDiaporamaImages');
        $this->addRelation('DiaporamaI18n', '\\Diaporamas\\Model\\DiaporamaI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'DiaporamaI18ns');
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'i18n' => array('i18n_table' => '%TABLE%_i18n', 'i18n_phpname' => '%PHPNAME%I18n', 'i18n_columns' => 'title', 'locale_column' => 'locale', 'locale_length' => '5', 'default_locale' => '', 'locale_alias' => '', ),
            'concrete_inheritance_parent' => array('descendant_column' => 'descendant_class', ),
        );
    } // getBehaviors()
    /**
     * Method to invalidate the instance pool of all tables related to diaporama     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in ".$this->getClassNameFromBuilder($joinedTableTableMapBuilder)." instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
                ProductDiaporamaTableMap::clearInstancePool();
                CategoryDiaporamaTableMap::clearInstancePool();
                BrandDiaporamaTableMap::clearInstancePool();
                FolderDiaporamaTableMap::clearInstancePool();
                ContentDiaporamaTableMap::clearInstancePool();
                DiaporamaI18nTableMap::clearInstancePool();
            }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {

            return (int) $row[
                            $indexType == TableMap::TYPE_NUM
                            ? 0 + $offset
                            : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
                        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? DiaporamaTableMap::CLASS_DEFAULT : DiaporamaTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     * @return array (Diaporama object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = DiaporamaTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DiaporamaTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DiaporamaTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DiaporamaTableMap::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DiaporamaTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = DiaporamaTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DiaporamaTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DiaporamaTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(DiaporamaTableMap::ID);
            $criteria->addSelectColumn(DiaporamaTableMap::SHORTCODE);
            $criteria->addSelectColumn(DiaporamaTableMap::DESCENDANT_CLASS);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.SHORTCODE');
            $criteria->addSelectColumn($alias . '.DESCENDANT_CLASS');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(DiaporamaTableMap::DATABASE_NAME)->getTable(DiaporamaTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getServiceContainer()->getDatabaseMap(DiaporamaTableMap::DATABASE_NAME);
      if (!$dbMap->hasTable(DiaporamaTableMap::TABLE_NAME)) {
        $dbMap->addTableObject(new DiaporamaTableMap());
      }
    }

    /**
     * Performs a DELETE on the database, given a Diaporama or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Diaporama object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DiaporamaTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Diaporamas\Model\Diaporama) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DiaporamaTableMap::DATABASE_NAME);
            $criteria->add(DiaporamaTableMap::ID, (array) $values, Criteria::IN);
        }

        $query = DiaporamaQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) { DiaporamaTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) { DiaporamaTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the diaporama table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return DiaporamaQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Diaporama or Criteria object.
     *
     * @param mixed               $criteria Criteria or Diaporama object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DiaporamaTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Diaporama object
        }

        if ($criteria->containsKey(DiaporamaTableMap::ID) && $criteria->keyContainsValue(DiaporamaTableMap::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DiaporamaTableMap::ID.')');
        }


        // Set the correct dbName
        $query = DiaporamaQuery::create()->mergeWith($criteria);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = $query->doInsert($con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

} // DiaporamaTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
DiaporamaTableMap::buildTableMap();
