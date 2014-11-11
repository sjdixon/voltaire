<?php

namespace Base;

use \Tournament as ChildTournament;
use \TournamentQuery as ChildTournamentQuery;
use \Exception;
use \PDO;
use Map\TournamentTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'tournament' table.
 *
 *
 *
 * @method     ChildTournamentQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildTournamentQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildTournamentQuery orderByStartDate($order = Criteria::ASC) Order by the startdate column
 * @method     ChildTournamentQuery orderByEndDate($order = Criteria::ASC) Order by the enddate column
 * @method     ChildTournamentQuery orderByHostClub($order = Criteria::ASC) Order by the hostClub column
 *
 * @method     ChildTournamentQuery groupById() Group by the id column
 * @method     ChildTournamentQuery groupByName() Group by the name column
 * @method     ChildTournamentQuery groupByStartDate() Group by the startdate column
 * @method     ChildTournamentQuery groupByEndDate() Group by the enddate column
 * @method     ChildTournamentQuery groupByHostClub() Group by the hostClub column
 *
 * @method     ChildTournamentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTournamentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTournamentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTournament findOne(ConnectionInterface $con = null) Return the first ChildTournament matching the query
 * @method     ChildTournament findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTournament matching the query, or a new ChildTournament object populated from the query conditions when no match is found
 *
 * @method     ChildTournament findOneById(int $id) Return the first ChildTournament filtered by the id column
 * @method     ChildTournament findOneByName(string $name) Return the first ChildTournament filtered by the name column
 * @method     ChildTournament findOneByStartDate(string $startdate) Return the first ChildTournament filtered by the startdate column
 * @method     ChildTournament findOneByEndDate(string $enddate) Return the first ChildTournament filtered by the enddate column
 * @method     ChildTournament findOneByHostClub(string $hostClub) Return the first ChildTournament filtered by the hostClub column
 *
 * @method     ChildTournament[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTournament objects based on current ModelCriteria
 * @method     ChildTournament[]|ObjectCollection findById(int $id) Return ChildTournament objects filtered by the id column
 * @method     ChildTournament[]|ObjectCollection findByName(string $name) Return ChildTournament objects filtered by the name column
 * @method     ChildTournament[]|ObjectCollection findByStartDate(string $startdate) Return ChildTournament objects filtered by the startdate column
 * @method     ChildTournament[]|ObjectCollection findByEndDate(string $enddate) Return ChildTournament objects filtered by the enddate column
 * @method     ChildTournament[]|ObjectCollection findByHostClub(string $hostClub) Return ChildTournament objects filtered by the hostClub column
 * @method     ChildTournament[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TournamentQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \Base\TournamentQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'debateclub', $modelName = '\\Tournament', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTournamentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTournamentQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTournamentQuery) {
            return $criteria;
        }
        $query = new ChildTournamentQuery();
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
     * @return ChildTournament|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TournamentTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TournamentTableMap::DATABASE_NAME);
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
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTournament A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, startdate, enddate, hostClub FROM tournament WHERE id = :p0';
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
            /** @var ChildTournament $obj */
            $obj = new ChildTournament();
            $obj->hydrate($row);
            TournamentTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildTournament|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
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
    public function findPks($keys, ConnectionInterface $con = null)
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
     * @return $this|ChildTournamentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TournamentTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTournamentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TournamentTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildTournamentQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(TournamentTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TournamentTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TournamentTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTournamentQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TournamentTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the startdate column
     *
     * Example usage:
     * <code>
     * $query->filterByStartDate('2011-03-14'); // WHERE startdate = '2011-03-14'
     * $query->filterByStartDate('now'); // WHERE startdate = '2011-03-14'
     * $query->filterByStartDate(array('max' => 'yesterday')); // WHERE startdate > '2011-03-13'
     * </code>
     *
     * @param     mixed $startDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTournamentQuery The current query, for fluid interface
     */
    public function filterByStartDate($startDate = null, $comparison = null)
    {
        if (is_array($startDate)) {
            $useMinMax = false;
            if (isset($startDate['min'])) {
                $this->addUsingAlias(TournamentTableMap::COL_STARTDATE, $startDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startDate['max'])) {
                $this->addUsingAlias(TournamentTableMap::COL_STARTDATE, $startDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TournamentTableMap::COL_STARTDATE, $startDate, $comparison);
    }

    /**
     * Filter the query on the enddate column
     *
     * Example usage:
     * <code>
     * $query->filterByEndDate('2011-03-14'); // WHERE enddate = '2011-03-14'
     * $query->filterByEndDate('now'); // WHERE enddate = '2011-03-14'
     * $query->filterByEndDate(array('max' => 'yesterday')); // WHERE enddate > '2011-03-13'
     * </code>
     *
     * @param     mixed $endDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTournamentQuery The current query, for fluid interface
     */
    public function filterByEndDate($endDate = null, $comparison = null)
    {
        if (is_array($endDate)) {
            $useMinMax = false;
            if (isset($endDate['min'])) {
                $this->addUsingAlias(TournamentTableMap::COL_ENDDATE, $endDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endDate['max'])) {
                $this->addUsingAlias(TournamentTableMap::COL_ENDDATE, $endDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TournamentTableMap::COL_ENDDATE, $endDate, $comparison);
    }

    /**
     * Filter the query on the hostClub column
     *
     * Example usage:
     * <code>
     * $query->filterByHostClub('fooValue');   // WHERE hostClub = 'fooValue'
     * $query->filterByHostClub('%fooValue%'); // WHERE hostClub LIKE '%fooValue%'
     * </code>
     *
     * @param     string $hostClub The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTournamentQuery The current query, for fluid interface
     */
    public function filterByHostClub($hostClub = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($hostClub)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $hostClub)) {
                $hostClub = str_replace('*', '%', $hostClub);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TournamentTableMap::COL_HOSTCLUB, $hostClub, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTournament $tournament Object to remove from the list of results
     *
     * @return $this|ChildTournamentQuery The current query, for fluid interface
     */
    public function prune($tournament = null)
    {
        if ($tournament) {
            $this->addUsingAlias(TournamentTableMap::COL_ID, $tournament->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tournament table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TournamentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TournamentTableMap::clearInstancePool();
            TournamentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TournamentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TournamentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TournamentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TournamentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TournamentQuery
