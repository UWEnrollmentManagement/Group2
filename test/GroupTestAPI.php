<?php

namespace UWDOEM\Group\Test;

// backward compatibility
if (!class_exists('\PHPUnit\Framework\TestCase') &&
    class_exists('\PHPUnit_Framework_TestCase')) {
    class_alias('\PHPUnit_Framework_TestCase', '\PHPUnit\Framework\TestCase');
}
use PHPUnit_Framework_TestCase;

require '../vendor/autoload.php';

// Intialize the required settings
define('UW_WS_BASE_PATH', 'https://iam-ws.u.washington.edu:7443/group_sws/v2/');
define('UW_WS_SSL_KEY_PATH', './test-certs/prod.schsupp.osfa.washington.edu.key');
define('UW_WS_SSL_CERT_PATH', './test-certs/prod.schsupp.osfa.washington.edu.pem');
define('UW_WS_SSL_KEY_PASSWD', 'money4You');  // Can be blank for no password: ''
define('UW_WS_VERBOSE', true);  // (Optional) Whether to include verbose cURL messages in error messages.


class GroupTestAPI extends \PHPUnit\Framework\TestCase
{

    public function testAPIGroup()
    {
        // Test live data existing group
        $p = new MockGroupAPI("3ff762ad88924cdd80d5b376c4ba3e1d");
        $this->assertEquals($p->getRegId(), "3ff762ad88924cdd80d5b376c4ba3e1d");

        // Test live data on nonexistent group
        $p = new MockGroupAPI("nosuchgroup");
        $this->assertEquals($p->getRegId(), '');
    }

    public function testParseGroupMembership()
    {
        // Test live data existing group
        $p = new MockGroupAPI("uw_enrollment_eis_gws_test");

        // Check the membership is working as expected
        $this->assertContains('bonifacp', $p->getMembers());
        $this->assertContains('jschilz', $p->getDirectMembers());

        $this->assertNotContains('blarg', $p->getMembers());
    }

    public function testGroupSearch()
    {
        // Test live data
        $p = new MockGroupAPI('');
        $results = $p->searchGroups('name=uw_enrollment_eis_gws_test');
        ;

        // Check the search returns the expected test group
        $this->assertContains(
            [   'regid' => '76c9668f17284516a047e1e1181abff2',
                'title' => 'UW Enrollment Test Group for GWS',
                'description' => ''],
            $results
        );
    }

    public function testAffiliates()
    {
        // Test live data existing group
        $p = new MockGroupAPI("76c9668f17284516a047e1e1181abff2");
        $g = $p->getAffiliate('google');
        $u = $p->getAffiliate('uwwi');
        $n = $p->getAffiliate('netid');

        $this->assertEquals($u['error'], 'no such affiliate');
        $this->assertEquals($g['affiliate_status'], 'I');
        $this->assertEquals($n['affiliate_status'], 'I');
    }

    public function testHistory()
    {
        // Test live data existing group
        $p = new MockGroupAPI("76c9668f17284516a047e1e1181abff2");
        $history = $p->getHistory();
        $this->assertEquals(
            $history[0],
            [   'date' => '1507937578338',
                'user' => 'bonifacp',
                'actas' => 'GrouperSysAdmin',
                'activity' => 'affiliate',
                'description' => "set affiliate 'google' to inactive (forward=sender=none)"
            ]
        );
    }
}

