<?php

namespace UWDOEM\Group;

use UWDOEM\Connection\Connection;
use Sunra\PhpSimple\HtmlDomParser;

/**
 * Container class for data received from Group Web Service and Student Web Service
 *
 * @package UWDOEM\Group
 */
class Group
{
    /** @var string */
    protected $identifier;

    /** @var string|null */
    protected $regid = null;
    /** @var array */
    protected $names = [];
    /** @var string */
    protected $title;
    /** @var string */
    protected $description;
    /** @var string */
    protected $contact;
    /** @var string */
    protected $createtime;
    /** @var string */
    protected $modifytime;
    /** @var string */
    protected $membermodifytime;

    /** @var string */
    protected $authnfactor;
    /** @var string */
    protected $classification;
    /** @var string */
    protected $dependson;
    /** @var string */
    protected $gid;

    /** @var string */
    protected $emailenabled;
    /** @var string */
    protected $publishemail;
    /** @var array */
    protected $authorigs = [];
    /** @var boolean */
    protected $reporttoorig = false;

    /** @var array */
    protected $admins = [];
    /** @var array */
    protected $updaters = [];
    /** @var array */
    protected $creators = [];
    /** @var array */
    protected $readers = [];
    /** @var array */
    protected $viewers = [];
    /** @var array */
    protected $optins = [];
    /** @var array */
    protected $optouts = [];
    /** @var string */
    protected $owners;

    /** @var array */
    protected $history = [];

    // if a group represents a course, course information is included in the group info
    /** @var string */
    protected $course_qtr;
    /** @var string */
    protected $course_year;
    /** @var string */
    protected $course_curr;
    /** @var string */
    protected $course_no;
    /** @var string */
    protected $course_sect;
    /** @var string */
    protected $course_sln;
    /** @var array */
    protected $course_instructors = [];

    /** @var array */
    protected $directmembers = [];
    /** @var array */
    protected $effectivemembers = [];

    /**
     * @return string
     */
    public function getRegid()
    {
        if (isset($this->regid) === false) {
            $this->getGroup();
        }
        return $this->regid;
    }

    /**
     * @return array
     */
    public function getNames()
    {
        if (isset($this->names) === false) {
            $this->getGroup();
        }
        return $this->names;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        if (isset($this->title) === false) {
            $this->getGroup();
        }
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        if (isset($this->description) === false) {
            $this->getGroup();
        }
        return $this->description;
    }

    /**
     * @return string
     */
    public function getContact()
    {
        if (isset($this->contact) === false) {
            $this->getGroup();
        }
        return $this->contact;
    }

    /**
     * @return string
     */
    public function getCreatetime()
    {
        if (isset($this->createtime) === false) {
            $this->getGroup();
        }
        return $this->createtime;
    }

    /**
     * @return string
     */
    public function getModifytime()
    {
        if (isset($this->modifytime) === false) {
            $this->getGroup();
        }
        return $this->modifytime;
    }

    /**
     * @return string
     */
    public function getMembermodifytime()
    {
        if (isset($this->membermodifytime) === false) {
            $this->getGroup();
        }
        return $this->membermodifytime;
    }

    /**
     * @return string
     */
    public function getAuthnfactor()
    {
        if (isset($this->authnfactor) === false) {
            $this->getGroup();
        }
        return $this->authnfactor;
    }

    /**
     * @return string
     */
    public function getClassification()
    {
        if (isset($this->classification) === false) {
            $this->getGroup();
        }
        return $this->classification;
    }

    /**
     * @return string
     */
    public function getDependson()
    {
        if (isset($this->dependson) === false) {
            $this->getGroup();
        }
        return $this->dependson;
    }
    /**
     * @return string
     */
    public function getGid()
    {
        if (isset($this->gid) === false) {
            $this->getGroup();
        }
        return $this->gid;
    }

    /**
     * @return string
     */
    public function getEmailenabled()
    {
        if (isset($this->emailenabled) === false) {
            $this->getGroup();
        }
        return $this->emailenabled;
    }

    /**
     * @return string
     */
    public function getPublishemail()
    {
        if (isset($this->publishemail) === false) {
            $this->getGroup();
        }
        return $this->publishemail;
    }

    /**
     * @return string
     */
    public function getAuthorigs()
    {
        if (isset($this->authorigs) === false) {
            $this->getGroup();
        }
        return $this->authorigs;
    }

    /**
     * @return array
     */
    public function getReporttoorig()
    {
        if (isset($this->reporttoorig) === false) {
            $this->getGroup();
        }
        return $this->reporttoorig;
    }

    /**
     * @return array
     */
    public function getAdmins()
    {
        if (isset($this->admins) === false) {
            $this->getGroup();
        }
        return $this->admins;
    }

    /**
     * @return array
     */
    public function getUpdaters()
    {
        if (isset($this->updaters) === false) {
            $this->getGroup();
        }
        return $this->updaters;
    }

    /**
     * @return array
     */
    public function getCreators()
    {
        if (isset($this->creators) === false) {
            $this->getGroup();
        }
        return $this->creators;
    }

    /**
     * @return array
     */
    public function getReaders()
    {
        if (isset($this->readers) === false) {
            $this->getGroup();
        }
        return $this->readers;
    }

    /**
     * @return array
     */
    public function getViewers()
    {
        if (isset($this->viewers) === false) {
            $this->getGroup();
        }
        return $this->viewers;
    }

    /**
     * @return array
     */
    public function getOptins()
    {
        if (isset($this->optins) === false) {
            $this->getGroup();
        }
        return $this->optins;
    }

    /**
     * @return array
     */
    public function getOptouts()
    {
        if (isset($this->optouts) === false) {
            $this->getGroup();
        }
        return $this->optouts;
    }

    /**
     * @return array
     */
    public function getMembers()
    {
        if (isset($this->members) === false) {
            $this->getDirectMembership();
            $this->getEffectiveMembership();
        }
        return array_merge($this->directmembers, $this->effectivemembers);
    }

    /**
     * @return array
     */
    public function getOwners()
    {
        if (isset($this->owners) === false) {
            $this->getGroup();
        }
        return $this->owners;
    }

    /**
     * @return string
     */
    public function getCourseQtr()
    {
        if (isset($this->course_qtr) === false) {
            $this->getGroup();
        }
        return $this->course_qtr;
    }

    /**
     * @return string
     */
    public function getCourseYear()
    {
        if (isset($this->course_year) === false) {
            $this->getGroup();
        }
        return $this->course_year;
    }

    /**
     * @return string
     */
    public function getCourseCurr()
    {
        if (isset($this->course_curr) === false) {
            $this->getGroup();
        }
        return $this->course_curr;
    }

    /**
     * @return string
     */
    public function getCourseNo()
    {
        if (isset($this->course_no) === false) {
            $this->getGroup();
        }
        return $this->course_no;
    }

    /**
     * @return string
     */
    public function getCourseSect()
    {
        if (isset($this->course_sect) === false) {
            $this->getGroup();
        }
        return $this->course_sect;
    }

    /**
     * @return string
     */
    public function getCourseSln()
    {
        if (isset($this->course_sln) === false) {
            $this->getGroup();
        }
        return $this->course_sln;
    }

    /**
     * @return array
     */
    public function getCourseInstructors()
    {
        if (isset($this->course_instructors) === false) {
            $this->getGroup();
        }
        return $this->course_instructors;
    }

    /**
     * @return array
     */
    public function getDirectmembers()
    {
        if (isset($this->directmembers) === false) {
            $this->getDirectMembership();
        }
        return $this->directmembers;
    }

    /**
     * @return array
     */
    public function getEffectivemembers()
    {
        if (isset($this->effectivemembers) === false) {
            $this->getEffectiveMembership();
        }
        return $this->effectivemembers;
    }

    /**
     * @return array
     */
    public function getHistory()
    {
        if (count($this->history) === 0) {
            $this->getGroupHistory();
        }
        return $this->history;
    }

    /** @var \UWDOEM\Connection\Connection */
    protected static $groupConnection;

    /**
     * Group constructor.
     * @param string $identifier
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
//        $this->getGroup();
        return $this;
    }

    /**
     * Queries GWS to generate a Group, given an identifier. Identifier may be group id, or group regid
     *
     * @return Group
     */
    public function getGroup()
    {
        /** @var null|Person $person */

        if (is_null($this->regid) === true) {
            try {
                $resp = static::getGroupConnection()->execGET(
                    $this->identifier
                );
            } catch (\Exception $e) {
                throw $e;
            }

            $this->parseGroup($resp);
        }

        return $this;
    }

    /**
     * Queries GWS to for groups. Search parameters are defined at
     * https://wiki.cac.washington.edu/display/infra/Groups+WebService+Search
     *
     * @param string $search_string E.G. "name=thing_one&stem=thing_two".
     * @return array
     */
    public function searchGroups($search_string)
    {
        $resp = static::makeConnection('')->execGET(
            "search/?$search_string"
        );
        return $this->parseSearch($resp);
    }

    /**
     * @param string $member_id E.G. 'bonifacp'.
     * @return string
     */
    public function getMember($member_id)
    {

        if (is_null($this->regid) === true) {
            throw new \Exception('Member Id not specified');
        } else {
            $resp = static::getGroupConnection()->execGET(
                "$this->identifier/member/$member_id"
            );

            return $this->parseMember($resp);
        }
    }

    /**
     * @param string $member_id E.G. 'bonifacp'.
     * @return string
     */
    public function getEffectiveMember($member_id)
    {
        if (is_null($this->regid) === true) {
            throw new \Exception('Member Id not specified');
        } else {
            $resp = static::makeConnection()->execGET(
                "$this->identifier/effective_member/$member_id"
            );

            return $resp;
        }
    }

    /**
     * @param string $affiliate_id May be identifier (uw_enrollment) or regid (3ff762ad88924cdd80d5b376c4ba3e1d).
     * @return array
     */
    public function getAffiliate($affiliate_id)
    {
        $resp = static::getGroupConnection()->execGET(
            "$this->identifier/affiliate/$affiliate_id"
        );

        return $this->parseAffiliate($resp);
    }

    /**
     * Queries GWS to get the groups history.
     * @return void
     */
    public function getGroupHistory()
    {
        $resp = static::getGroupConnection()->execGET(
            "$this->identifier/history"
        );

        $this->parseHistory($resp);
    }

    /**
     * Queries GWS to for direct members of the group. Members are added to the object.
     * @return void
     */
    protected function getDirectMembership()
    {
        if (isset($this->regid) === false) {
            $this->getGroup();
        }
        if (is_null($this->regid) === true) {
            throw new \Exception('Group Id not specified');
        }
        $resp = static::getGroupConnection()->execGET(
            "$this->identifier/member"
        );

        $this->directmembers = [];
        $this->parseMembership($resp);
    }

    /**
     * Queries GWS to for effective members of the group. Members are added to the object.
     * @return void
     */
    protected function getEffectiveMembership()
    {
        if (isset($this->regid) === false) {
            $this->getGroup();
        }
        if (is_null($this->regid) === true) {
            throw new \Exception('Group Id not specified');
        }
        try {
            $resp = static::getGroupConnection()->execGET(
                "$this->identifier/effective_member"
            );
        } catch (\Exception $e) {
            throw $e;
        }

        $this->effectivemembers = [];
        $this->parseMembership($resp);
    }


    /**
     * @param string $baseUrl
     * @return Connection
     * @throws \Exception If any of the required constants have not been set.
     */
    protected static function makeConnection($baseUrl)
    {
        $requiredConstants = ["UW_GWS_BASE_PATH", "UW_GWS_SSL_KEY_PATH", "UW_GWS_SSL_CERT_PATH", "UW_GWS_SSL_KEY_PASSWD"];
        foreach ($requiredConstants as $constant) {
            if (defined($constant) === false) {
                throw new \Exception("You must define the constant $constant before using this library.");
            }
        }

        return new Connection(
            UW_GWS_BASE_PATH . $baseUrl,
            UW_GWS_SSL_KEY_PATH,
            UW_GWS_SSL_CERT_PATH,
            UW_GWS_SSL_KEY_PASSWD,
            defined("UW_GWS_VERBOSE") && UW_GWS_VERBOSE
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

    /**
     * @param string $data
     * @return void
     */
    protected function parseGroup($data)
    {
        $html = HtmlDomParser::str_get_html($data);
        $this->regid = (is_null($html->find("span.regid", 0)) === false)
                            ? $html->find("span.regid", 0)->innertext
                            : null;

        // Determine if the query returned an actual Group, or en empty object.
        // GWS has some templating issues, where missing data leaves the templating code. So if it's missing the regid,
        // we just skip the rest of the parsing.
        if ($this->regid === '${group.regid}') {
            $this->regid = null;
        } else {
            //Get the basic/core Group data
            $this->title             = (is_null($html->find("span.title           ", 0)) === false)
                                            ? $html->find("span.title           ", 0)->innertext
                                            : null;

            $this->description       = (is_null($html->find("span.description     ", 0)) === false)
                                            ? $html->find("span.description     ", 0)->innertext
                                            : null;

            $this->contact           = (is_null($html->find("span.contact         ", 0)) === false)
                                            ? $html->find("span.contact         ", 0)->innertext
                                            : null;

            $this->createtime        = (is_null($html->find("span.createtime      ", 0)) === false)
                                            ? $html->find("span.createtime      ", 0)->innertext
                                            : null;

            $this->modifytime        = (is_null($html->find("span.modifytime      ", 0)) === false)
                                            ? $html->find("span.modifytime      ", 0)->innertext
                                            : null;

            $this->membermodifytime  = (is_null($html->find("span.membermodifytime", 0)) === false)
                                            ? $html->find("span.membermodifytime", 0)->innertext
                                            : null;

            $this->authnfactor       = (is_null($html->find("span.authnfactor     ", 0)) === false)
                                            ? $html->find("span.authnfactor     ", 0)->innertext
                                            : null;

            $this->classification    = (is_null($html->find("span.classification  ", 0)) === false)
                                            ? $html->find("span.classification  ", 0)->innertext
                                            : null;

            $this->dependson         = (is_null($html->find("span.dependson       ", 0)) === false)
                                            ? $html->find("span.dependson       ", 0)->innertext
                                            : null;

            $this->gid               = (is_null($html->find("span.gid             ", 0)) === false)
                                            ? $html->find("span.gid             ", 0)->innertext
                                            : null;

            $this->emailenabled      = (is_null($html->find("span.emailenabled    ", 0)) === false)
                                            ? $html->find("span.emailenabled    ", 0)->innertext
                                            : null;

            $this->publishemail      = (is_null($html->find("span.publishemail    ", 0)) === false)
                                            ? $html->find("span.publishemail    ", 0)->innertext
                                            : null;

            $this->reporttoorig      = (is_null($html->find("span.reporttoorig    ", 0)) === false)
                                            ? $html->find("span.reporttoorig    ", 0)->innertext
                                            : null;

            $this->status            = (is_null($html->find("div.status           ", 0)) === false)
                                            ? $html->find("div.status           ", 0)->innertext
                                            : null;

            foreach ($html->find('span.name') as $name) {
                array_push($this->names, $name->innertext);
            }
            foreach ($html->find('li.authorig') as $authorig) {
                array_push($this->authorigs, $authorig->innertext);
            }
            foreach ($html->find('li.admin') as $admin) {
                array_push($this->admins, $admin->innertext);
            }
            foreach ($html->find('li.updater') as $updater) {
                array_push($this->updaters, $updater->innertext);
            }
            foreach ($html->find('li.reader') as $reader) {
                array_push($this->readers, $reader->innertext);
            }
            foreach ($html->find('li.optin') as $optin) {
                array_push($this->optins, $optin->innertext);
            }
            foreach ($html->find('li.optout') as $optout) {
                array_push($this->optours, $optout->innertext);
            }

            // Course fields are optional in the GWS XHTML
            foreach ($html->find('li.course_instructor') as $instructor) {
                array_push($this->course_instructors, $instructor->innertext);
            }

            $this->course_qtr  = (is_null($html->find("span.course_qtr", 0)) === false)
                                    ? $html->find("span.course_qtr", 0)->innertext
                                    : null;

            $this->course_year = (is_null($html->find("span.course_year", 0)) === false)
                                    ? $html->find("span.course_year", 0)->innertext
                                    : null;

            $this->course_curr = (is_null($html->find("span.course_curr", 0)) === false)
                                    ? $html->find("span.course_curr", 0)->innertext
                                    : null;

            $this->course_no   = (is_null($html->find("span.course_no", 0)) === false)
                                    ? $html->find("span.course_no", 0)->innertext
                                    : null;

            $this->course_sect = (is_null($html->find("span.course_sect", 0)) === false)
                                    ? $html->find("span.course_sect", 0)->innertext
                                    : null;

            $this->course_sln  = (is_null($html->find("span.course_sln", 0)) === false)
                                    ? $html->find("span.course_sln", 0)->innertext
                                    : null;
        }
    }

    /**
     * parses Membership data and saves it to the Group object
     *
     * @param string $data
     * @return void
     */
    protected function parseMembership($data)
    {
        $html = HtmlDomParser::str_get_html($data);
        foreach ($html->find('a.member') as $name) {
            array_push($this->directmembers, $name->innertext);
        }
        foreach ($html->find('a.effective_member') as $name) {
            array_push($this->effectivemembers, $name->innertext);
        }
    }

    /**
     * parses History data and saves it to the Group object
     *
     * @param string $data
     * @return void
     */
    protected function parseHistory($data)
    {
        $this->history = [];
        $html = HtmlDomParser::str_get_html($data);
        foreach ($html->find('li.history') as $e) {
            $item = array();
            $item['date'] =  $e->date;
            $item['user'] =  $e->user;
            $item['actas'] =  $e->actas;
            $item['activity'] =  $e->activity;
            $item['description'] = $e->description;
            array_push($this->history, $item);
        }
    }

/**
 *      Why? Because it's in the API
 *      Why is it in the API? ¯\_(ツ)_/¯
 * /

    /**
     * parses Member data and returns it
     * @param string $data
     * @return string member name
     */
    protected function parseMember($data)
    {
        $html = HtmlDomParser::str_get_html($data);
        return $html->find('span.member', 0)->innertext;
    }

    /**
     * Parses out affiliate information from the GWS XHTML. Successful queries will also be added to the Group object.
     *
     * @param string $data
     * @return array affiliate information
     */
    protected function parseAffiliate($data)
    {
        $html = HtmlDomParser::str_get_html($data);
        $affiliate['group_identifier']  = (empty($html->find('span.identifier', 0)) === false)
                                            ? ($html->find('span.identifier', 0)->innertext)
                                            : ('');
        $affiliate['affiliate_name']    = (empty($html->find('span.affiliate', 0)) === false)
                                            ? ($html->find('span.affiliate', 0)->name)
                                            : ('');
        $affiliate['affiliate_status']  = (empty($html->find('span.affiliate', 0)) === false)
                                            ? ($html->find('span.affiliate', 0)->status)
                                            : ('');
        $affiliate['error']             = (empty($html->find('span.error', 0)) === false)
                                            ? ($html->find('span.error', 0)->innertext)
                                            : ('');

        if ($html->find('span.error', 0) === true) {
        } else {
            $this->affiliates[$affiliate['affiliate_name']] = $affiliate;
        }

        return $affiliate;
    }

    /**
     * Parses out group information from a search.
     *
     * @param string $data
     * @return array group information
     */
    protected function parseSearch($data)
    {
        $html = HtmlDomParser::str_get_html($data);
        $groups = array();
        foreach ($html->find('li.groupreference') as $e) {
            $item = array();
            $item['regid'] =  $e->find('span.regid', 0)->innertext;
            $item['title'] =  $e->find('span.title', 0)->innertext;
            $item['description'] = $e->find('span.description', 0)->innertext;
            array_push($groups, $item);
        }
        return $groups;
    }
}
