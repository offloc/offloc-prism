<?php

/**
 * This file is a part of offloc/router-core.
 *
 * (c) Offloc Incorporated
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Offloc\Router\Domain\Model;

/**
 * Defines the Session interface
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
interface SessionInterface
{
    /**
     * Tells the Session to make an instance managed and persistent.
     *
     * The object will be entered into the database as a result of the flush operation.
     *
     * NOTE: The persist operation always considers objects that are not yet known to
     * this Session as NEW. Do not pass detached objects to the persist operation.
     *
     * @param object $object The instance to make managed and persistent.
     */
    public function persist($object);

    /**
     * Removes an object instance.
     *
     * A removed object will be removed from the database as a result of the flush operation.
     *
     * @param object $object The object instance to remove.
     */
    public function remove($object);

    /**
     * Merges the state of a detached object into the persistence context
     * of this Session and returns the managed copy of the object.
     * The object passed to merge will not become associated/managed with this Session.
     *
     * @param object $object
     */
    public function merge($object);

    /**
     * Clears the Session. All objects that are currently managed
     * by this Session become detached.
     *
     * @param string $objectName if given, only objects of this type will get detached
     */
    public function clear($objectName = null);

    /**
     * Detaches an object from the Session, causing a managed object to
     * become detached. Unflushed changes made to the object if any
     * (including removal of the object), will not be synchronized to the database.
     * Objects which previously referenced the detached object will continue to
     * reference it.
     *
     * @param object $object The object to detach.
     */
    public function detach($object);

    /**
     * Refreshes the persistent state of an object from the database,
     * overriding any local changes that have not yet been persisted.
     *
     * @param object $object The object to refresh.
     */
    public function refresh($object);

    /**
     * Flushes all changes to objects that have been queued up to now to the database.
     * This effectively synchronizes the in-memory state of managed objects with the
     * database.
     */
    public function flush();

    /**
     * Executes a function in a transaction.
     *
     * The function gets passed this Session instance as an (optional) parameter.
     *
     * {@link flush} is invoked prior to transaction commit.
     *
     * If an exception occurs during execution of the function or flushing or transaction commit,
     * the transaction is rolled back, the Session closed and the exception re-thrown.
     *
     * @param callable $func The function to execute transactionally.
     *
     * @return mixed Returns the non-empty value returned from the closure or true instead
     */
    public function transactional($func);
}
