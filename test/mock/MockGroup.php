<?php

namespace UWDOEM\Group\Test;

use UWDOEM\Connection\Connection;
use UWDOEM\Group\Group;
use Sunra\PhpSimple\HtmlDomParser;

class MockGroup extends Group
{

    /**
     * Queries GWS to generate a Group, given an identifier. Identifier may be group id, or group regid
     *
     * @param string $identifier may be identifier (e.g. uw_enrollment) or regid (e. g 7)
     */
    public function getMockGroup()
    {
        if (is_null($this->regid)) {
            $resp = <<<FOO
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<div class="group" version="2">

Regid: <span class="regid">3ff762ad88924cdd80d5b376c4ba3e1d</span>
<br>
<span class="names">
Name: <span class="name">uw_enrollment_eis</span>
</span>
<br>
Title: <span class="title">EIS Team</span>
<br>
Description: <span class="description">uw_enrollment_eis</span>
<br>

Group contact: <span class="contact"></span>
<br>

Created: <span class="createtime">1484941165753</span>
<br>
Modified: <span class="modifytime">1484955095974</span>
<br>
Membership modified: <span class="membermodifytime">1500306413978</span>
<br>
Authn factor: <span class="authnfactor">1</span>
<br>
Classification: <span class="classification">u</span>
<br>
Membership dependency group: <span class="dependson"></span>
<br>
GID: <span class="gid">394936</span>


<span class="affiliates">
          <span class="affiliate" name="radius" status="active">
     <span class="affiliate" name="netid" status="active" forward="uw_enrollment_eis@exchange.washington.edu">
  </span>


Email Enabled: <span class="emailenabled">uwexchange</span>
<br>

Published email address: <span class="publishemail">uw_enrollment_eis@uw.edu</span>
<br>

Report to owner:
<span class="reporttoowner">no</span>
<br>

Allowed senders: <ul class="authorigs">
            <li class="authorig" type="none">dc=all</li>
      </ul>







Administrators:
<ul class="admins">
      <li class="admin" type="uwnetid">adamsd3</li>
         <li class="admin" type="uwnetid">dale</li>
         <li class="admin" type="uwnetid">msaavedr</li>
   </ul>
Updaters:
<ul class="updaters">
      <li class="updater" type="uwnetid">helenbg</li>
         <li class="updater" type="uwnetid">cfish</li>
   </ul>
Creators:
<ul class="creators">
</ul>
Readers:
<ul class="readers">
      <li class="reader" type="none">dc=all</li>
   </ul>

Optins:
<ul class="optins">
</ul>
Optouts:
<ul class="optouts">
</ul>

<br>

Membership: <a rel="members" href="/group_sws/v2/group/3ff762ad88924cdd80d5b376c4ba3e1d/member">Membership</a>

</span></span></div>

<div class="status"></div>

FOO;

            $this->parseGroup($resp);
        }
        return $this;
    }

    /**
     * @param string $baseUrl
     * @return Connection
     * @throws \Exception If any of the required constants have not been set.
     */
    protected static function makeConnection($baseUrl)
    {
        $requiredConstants = ["UW_WS_BASE_PATH", "UW_WS_SSL_KEY_PATH", "UW_WS_SSL_CERT_PATH", "UW_WS_SSL_KEY_PASSWD"];

        foreach ($requiredConstants as $constant) {
            if (defined($constant) === false) {
                throw new \Exception("You must define the constant $constant before using this library.");
            }
        }
        return new Connection(
            UW_WS_BASE_PATH . $baseUrl,
            UW_WS_SSL_KEY_PATH,
            UW_WS_SSL_CERT_PATH,
            UW_WS_SSL_KEY_PASSWD,
            defined("UW_WS_VERBOSE") && UW_WS_VERBOSE,
            [CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false]
        );
    }

    /**
     * @return Connection
     */
    protected static function getGroupConnection()
    {
        if (static::$groupConnection === null) {
            static::$groupConnection = static::makeConnection("group/");
        }
        return static::$groupConnection;
    }
}

