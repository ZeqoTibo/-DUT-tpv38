<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace AppBundle;

use Doctrine\DBAL\Event\ConnectionEventArgs;
use Doctrine\DBAL\Events;
use Doctrine\Common\EventSubscriber;

/**
 * Sqlite Session Init Event Subscriber which allows to configure specific pragma statements.
 *
 * @link       www.doctrine-project.org
 * @since      1.0
 * @author     Alain Corbière <alain.corbiere@univ-lemans.fr>
 */
class SqliteSessionInit implements EventSubscriber
{
    /**
     * The array of options (pragma).
     *
     * @var array
     */
    private $_pragma;

    /**
     * Configure the specific pragma statements (https://sqlite.org/pragma.html)
     *
     * @param array       
     */
    public function __construct($pragma = null)
    {
        if (is_array ($pragma))
            $this->_pragma = $pragma ;
        else
            $this->_pragma = array() ;
    }

    /**
     * @param \Doctrine\DBAL\Event\ConnectionEventArgs $args
     *
     * @return void
     */
    public function postConnect(ConnectionEventArgs $args)
    {
        foreach($this->_pragma as $param => $value) {
            $args->getConnection()->exec('PRAGMA '.$param.' = '.$value);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents()
    {
        return array(Events::postConnect);
    }
}
