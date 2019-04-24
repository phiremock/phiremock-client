<?php
/**
 * This file is part of Phiremock.
 *
 * Phiremock is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Phiremock is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Phiremock.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Mcustiel\Phiremock\Client;

use GuzzleHttp\Client as GuzzleClient;
use Mcustiel\Phiremock\Client\Connection\Host;
use Mcustiel\Phiremock\Client\Connection\Port;
use Mcustiel\Phiremock\Common\Http\Implementation\GuzzleConnection;
use Mcustiel\Phiremock\Factory as PhiremockFactory;

class Factory
{
    const CLIENT_CONFIG = [
        'http_errors' => false,
    ];

    /** @return \Mcustiel\Phiremock\Client\Phiremock */
    public function createPhiremockClient(Host $host, Port $port)
    {
        return new Phiremock(
            $host,
            $port,
            $this->createRemoteConnection(),
            $this->createArrayToExpectationConverter()
        );
    }

    /** @return GuzzleConnection */
    public function createRemoteConnection()
    {
        return new GuzzleConnection(
            new GuzzleClient(self::CLIENT_CONFIG)
        );
    }
}
