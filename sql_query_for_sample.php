select * from studentstrength where typeid in ( select schooltype from staffhead where reportingperiod='2015-04-17')

select school.SchoolName, studentstrength.typeid, sum(studentstrength.tboy) as "tibetanboys", sum(studentstrength.tgirl) as "tibetangirls", sum(tboy) + sum( tgirl) as "Total", staffhead.reportingperiod from studentstrength inner join staffhead ON studentstrength.typeid = staffhead.schooltype INNER JOIN school on school.SchoolID = staffhead.schoolid where staffhead.reportingperiod='2015-04-17' GROUP by school.SchoolName


select school.SchoolName, 
sum(studentstrength.tboy) as "tibetanboys", sum(studentstrength.tgirl) as "tibetangirls", sum(tboy) + sum(tgirl) as "Total", sum(studentstrength.hboy) as "himalayanboys", sum(studentstrength.hgirl) as "himalayangirls", sum(hboy) + sum(hgirl) as "total", 
sum(studentstrength.iboy) as "Idianboys", sum(studentstrength.igirl) as "Indiangirls", sum(iboy) + sum(igirl) as "total", 
sum(studentstrength.dboy) as "Dayboys", sum(studentstrength.dgirl) as "Daygirls", sum(dboy) + sum(dgirl) as "total", 
sum(studentstrength.bboy) as "boardingboys", sum(studentstrength.bgirl) as "boardinggirls", sum(bboy) + sum(bgirl) as "total", sum(dboy) + sum(bboy) as "TotalBoy",
sum(dgirl) + sum(bgirl) as "TotalGirl", 
sum(dboy) + sum(bboy) + sum(dgirl) + sum(bgirl) as "Grand Total",
staffhead.deadline from studentstrength inner join staffhead ON studentstrength.typeid = staffhead.schooltype INNER JOIN school on school.SchoolID = staffhead.schoolid where staffhead.deadline='2006-12-31' GROUP by school.




select school.SchoolName, sum(studentstrength.tboy) as "tibetanboys", sum(studentstrength.tgirl) as "tibetangirls", sum(tboy) + sum(tgirl) as "Total", sum(studentstrength.hboy) as "himalayanboys", sum(studentstrength.hgirl) as "himalayangirls", sum(hboy) + sum(hgirl) as "total", sum(studentstrength.iboy) as "Idianboys", sum(studentstrength.igirl) as "Indiangirls", sum(iboy) + sum(igirl) as "total", 
sum(studentstrength.dboy) as "Dayboys", sum(studentstrength.dgirl) as "Daygirls", sum(dboy) + sum(dgirl) as "total", 
sum(studentstrength.bboy) as "boardingboys", sum(studentstrength.bgirl) as "boardinggirls", sum(bboy) + sum(bgirl) as "total", sum(dboy) + sum(bboy) as "TotalBoy",
sum(dgirl) + sum(bgirl) as "TotalGirl", sum(dboy) + sum(bboy) + sum(dgirl) + sum(bgirl) as "Grand Total",
staffhead.deadline from studentstrength inner join staffhead ON studentstrength.typeid = staffhead.schooltype INNER JOIN school on school.SchoolID = staffhead.schoolid where staffhead.deadline='2006-12-31' GROUP by school.SchoolName order by school.sortby ASC

//School wise class wise student population
$sql = "SELECT 
	schoolcategory.schoolcatname, 
	schoolcategory.SchoolCategoryName, 
	school.SchoolName, 
	Sum(tboy) AS tibetanboys, 
Sum(tgirl) AS tibetengirls, 
Sum(tboy + tgirl) AS total1, 
Sum(nboy) AS himalayanboys, 
Sum(ngirl) AS himalayangirls, 
Sum(nboy + ngirl) AS total2, 
sum(hboy) as 'Indianboys', 
sum(hgirl) as 'Indiangirls', 
	sum(hboy + hgirl) as 'total3', 
Sum(dboy) AS Dayboys, 
Sum(dgirl) AS Daygirls, 
Sum(dboy + dgirl) AS total4, 
Sum(bboy) AS boardingboys, 
Sum(bgirl) AS boardinggirls, 

Sum(bboy + bgirl) AS total5, 
Sum(dboy + bboy) AS TotalBoy, 
Sum(dgirl + dgirl) AS TotalGirl, 
sum(dboy + bboy + dgirl + bgirl) as 'Grand Total', 
staffhead.deadline, 
class.class, 
school.sortby, 
class.sortby, 
school.status 
FROM 
	class 
	INNER JOIN (
		schoolcategory 
		INNER JOIN (
			(
				school 
				INNER JOIN staffhead ON school.SchoolID = staffhead.schoolid
			) 
			INNER JOIN studentstrength ON staffhead.schooltype = studentstrength.typeid
		) ON schoolcategory.SchoolCategoryId = school.SchoolCategoryId
	) ON class.classid = studentstrength.class 
WHERE 
	staffhead.deadline = '2015-12-31' 
GROUP BY 
	schoolcategory.schoolcatname, 
	schoolcategory.SchoolCategoryName, 
	school.SchoolName, 
	staffhead.deadline, 
	class.class, 
	school.sortby, 
	class.sortby, 
	school.status 
ORDER BY 
	school.SchoolName,
	school.sortby, 
	class.sortby";


//class wise student population

select 
	class.class, 
	sum(studentstrength.tboy) as 'tibetanboys', 
	sum(studentstrength.tgirl) as 'tibetangirls', 
	sum(tboy) + sum(tgirl) as 'total1', 
	sum(studentstrength.nboy) as 'himalayanboys', 
	sum(studentstrength.ngirl) as 'himalayangirls', 
	sum(nboy) + sum(ngirl) as 'total2', 
	sum(studentstrength.hboy) as 'Indianboys', 
	sum(studentstrength.hgirl) as 'Indiangirls', 
	sum(hboy) + sum(hgirl) as 'total3', 
	sum(studentstrength.dboy) as 'Dayboys', 
	sum(studentstrength.dgirl) as 'Daygirls', 
	sum(dboy) + sum(dgirl) as 'total4', 
	sum(studentstrength.bboy) as 'boardingboys', 
	sum(studentstrength.bgirl) as 'boardinggirls', 
	sum(bboy) + sum(bgirl) as 'total5', 
	sum(dboy) + sum(bboy) as 'TotalBoy', 
	sum(dgirl) + sum(bgirl) as 'TotalGirl', 
	sum(dboy) + sum(bboy) + sum(dgirl) + sum(bgirl) as 'Grand Total', 
	staffhead.deadline 
from 
	studentstrength 
	inner join staffhead ON studentstrength.typeid = staffhead.schooltype 
	INNER JOIN class on class.classid = studentstrength.class 
where 
	staffhead.deadline = '2015-12-31' 
GROUP by 
	class.class 
    ORDER by 
    class.classid
    

# Latest Data OF Student
select school.sortby,school.SchoolName,sum(dboy) + sum(bboy) + sum(dgirl) + sum(bgirl) as "Student", 
staffhead.deadline from studentstrength inner join staffhead ON studentstrength.typeid = staffhead.schooltype INNER JOIN school on school.SchoolID = staffhead.schoolid where staffhead.deadline='2013-12-31' GROUP by school.SchoolName order by school.sortby ASC

select school.SchoolName,sum(dboy) + sum(bboy) + sum(dgirl) + sum(bgirl) as "Grand Total",
staffhead.deadline from studentstrength inner join staffhead ON studentstrength.typeid = staffhead.schooltype INNER JOIN school on school.SchoolID = staffhead.schoolid INNER JOIN staffstrength on staffstrength.schoolinfo = studentstrength.typeid where staffhead.deadline='2006-12-31' GROUP by school.SchoolName order by school.sortby ASC

# Latest data of Staff
	$sql = "select school.sortby,school.SchoolName,truncate((sum(Female) + sum(Male)) / 2, 0) as 'Staff', 
staffhead.deadline from staffstrength inner join staffhead ON staffstrength.schoolinfo = staffhead.schooltype INNER JOIN school on school.SchoolID = staffhead.schoolid where staffhead.deadline= '2014-12-31' GROUP by school.SchoolName order by school.sortby ASC";
	

select school.sortby,school.SchoolName,(sum(Female) + sum(Male))/2 as "Staff", 
staffhead.deadline from staffstrength inner join staffhead ON staffstrength.schoolinfo = staffhead.schooltype INNER JOIN school on school.SchoolID = staffhead.schoolid where staffhead.deadline= '2014-12-31' GROUP by school.SchoolName order by school.sortby ASC



# Select student total, Minimum of class, Maximum of class, reporting date

SELECT school.SchoolName, Sum((tboy+tgirl+nboy+ngirl)) AS stutot, MIN(class.class) AS MinOfclass, MAX(class.class) AS MaxOfclass, staffhead.reportingperiod
                     FROM class INNER JOIN (((SELECT staffhead.schoolid, 
                    MAX(staffhead.deadline) AS MaxOfdeadline FROM staffhead GROUP BY staffhead.schoolid) AS SQ INNER JOIN 
                     (school INNER JOIN staffhead ON school.SchoolID = staffhead.schoolid) ON (SQ.MaxOfdeadline = staffhead.deadline) 
                     AND (SQ.schoolid = staffhead.schoolid)) INNER JOIN studentstrength ON staffhead.schooltype = studentstrength.typeid) 
                     ON class.classid = studentstrength.class where school.status='A' GROUP BY school.SchoolName, staffhead.deadline order by school.schoolName







//School_wise_class Query


SELECT SchoolName,
MAX(CASE WHEN class = 1 THEN (tboy+tgirl+nboy+ngirl+hboy+hgirl+dboy+dgirl+bboy+bgirl) END) PrePrimary,
MAX(CASE WHEN class = 2 THEN (tboy+tgirl+nboy+ngirl+hboy+hgirl+dboy+dgirl+bboy+bgirl) END)  Class_I,
MAX(CASE WHEN class = 3 THEN (tboy+tgirl+nboy+ngirl+hboy+hgirl+dboy+dgirl+bboy+bgirl) END) Class_II,
MAX(CASE WHEN class = 4 THEN (tboy+tgirl+nboy+ngirl+hboy+hgirl+dboy+dgirl+bboy+bgirl) END) Class_III,
MAX(CASE WHEN class = 5 THEN (tboy+tgirl+nboy+ngirl+hboy+hgirl+dboy+dgirl+bboy+bgirl) END) Class_IV,
MAX(CASE WHEN class = 6 THEN (tboy+tgirl+nboy+ngirl+hboy+hgirl+dboy+dgirl+bboy+bgirl) END) Class_V,
MAX(CASE WHEN class = 7 THEN (tboy+tgirl+nboy+ngirl+hboy+hgirl+dboy+dgirl+bboy+bgirl) END) Class_VI,
MAX(CASE WHEN class = 8 THEN (tboy+tgirl+nboy+ngirl+hboy+hgirl+dboy+dgirl+bboy+bgirl) END) Class_VII,
MAX(CASE WHEN class = 9 THEN (tboy+tgirl+nboy+ngirl+hboy+hgirl+dboy+dgirl+bboy+bgirl) END) Class_VIII,
MAX(CASE WHEN class = 10 THEN (tboy+tgirl+nboy+ngirl+hboy+hgirl+dboy+dgirl+bboy+bgirl) END) Class_IX,
MAX(CASE WHEN class = 11 THEN (tboy+tgirl+nboy+ngirl+hboy+hgirl+dboy+dgirl+bboy+bgirl) END) Class_X,
MAX(CASE WHEN class = 12 THEN (tboy+tgirl+nboy+ngirl+hboy+hgirl+dboy+dgirl+bboy+bgirl) END) Class_XI_Sc,
MAX(CASE WHEN class = 13 THEN (tboy+tgirl+nboy+ngirl+hboy+hgirl+dboy+dgirl+bboy+bgirl) END) Class_XI_Com,
MAX(CASE WHEN class = 14 THEN (tboy+tgirl+nboy+ngirl+hboy+hgirl+dboy+dgirl+bboy+bgirl) END) Class_XI_Hum,
MAX(CASE WHEN class = 15 THEN (tboy+tgirl+nboy+ngirl+hboy+hgirl+dboy+dgirl+bboy+bgirl) END) Class_XI_Voc,
MAX(CASE WHEN class = 16 THEN (tboy+tgirl+nboy+ngirl+hboy+hgirl+dboy+dgirl+bboy+bgirl) END) Class_XII_Com,
MAX(CASE WHEN class = 17 THEN (tboy+tgirl+nboy+ngirl+hboy+hgirl+dboy+dgirl+bboy+bgirl) END) Class_XII_Hum,
MAX(CASE WHEN class = 18 THEN (tboy+tgirl+nboy+ngirl+hboy+hgirl+dboy+dgirl+bboy+bgirl) END) Class_XII_Sc,
MAX(CASE WHEN class = 19 THEN (tboy+tgirl+nboy+ngirl+hboy+hgirl+dboy+dgirl+bboy+bgirl) END) Class_XII_Voc,
MAX(CASE WHEN class = 20 THEN (tboy+tgirl+nboy+ngirl+hboy+hgirl+dboy+dgirl+bboy+bgirl) END) Special_Class,
MAX(CASE WHEN class = 21 THEN (tboy+tgirl+nboy+ngirl+hboy+hgirl+dboy+dgirl+bboy+bgirl) END) OC
FROM studentstrength ss 
inner join staffhead on ss.typeid = staffhead.schooltype 
inner join school on staffhead.schoolid = school.SchoolID
where staffhead.deadline='2015-12-31'
GROUP By school.SchoolName
ORDER BY school.sortby ASC



//Final School_wise_class Query

SELECT SchoolName,
IFNULL(MAX(CASE WHEN class = 1 THEN (dboy+dgirl+bboy+bgirl) END),0) PrePrimary,
IFNULL(MAX(CASE WHEN class = 2 THEN (dboy+dgirl+bboy+bgirl) END),0)  I,
IFNULL(MAX(CASE WHEN class = 3 THEN (dboy+dgirl+bboy+bgirl) END),0)  II,
IFNULL(MAX(CASE WHEN class = 4 THEN (dboy+dgirl+bboy+bgirl) END),0)  III,
IFNULL(MAX(CASE WHEN class = 5 THEN (dboy+dgirl+bboy+bgirl) END),0)  IV,
IFNULL(MAX(CASE WHEN class = 6 THEN (dboy+dgirl+bboy+bgirl) END),0)V,
IFNULL(MAX(CASE WHEN class = 7 THEN (dboy+dgirl+bboy+bgirl) END),0)  VI,
IFNULL(MAX(CASE WHEN class = 8 THEN (dboy+dgirl+bboy+bgirl) END),0)  VII,
IFNULL(MAX(CASE WHEN class = 9 THEN (dboy+dgirl+bboy+bgirl) END),0)  VIII,
IFNULL(MAX(CASE WHEN class = 10 THEN (dboy+dgirl+bboy+bgirl) END),0) IX,
IFNULL(MAX(CASE WHEN class = 11 THEN (dboy+dgirl+bboy+bgirl) END),0) X,
IFNULL(MAX(CASE WHEN class = 12 THEN (dboy+dgirl+bboy+bgirl) END),0) XI_Sc,
IFNULL(MAX(CASE WHEN class = 13 THEN (dboy+dgirl+bboy+bgirl) END),0) XI_Com,
IFNULL(MAX(CASE WHEN class = 14 THEN (dboy+dgirl+bboy+bgirl) END),0) XI_Hum,
IFNULL(MAX(CASE WHEN class = 15 THEN (dboy+dgirl+bboy+bgirl) END),0) XI_Voc,
IFNULL(MAX(CASE WHEN class = 16 THEN (dboy+dgirl+bboy+bgirl) END),0) XII_Com,
IFNULL(MAX(CASE WHEN class = 17 THEN (dboy+dgirl+bboy+bgirl) END),0) XII_Hum,
IFNULL(MAX(CASE WHEN class = 18 THEN (dboy+dgirl+bboy+bgirl) END),0) XII_Sc,
IFNULL(MAX(CASE WHEN class = 19 THEN (dboy+dgirl+bboy+bgirl) END),0) XII_Voc,
IFNULL(MAX(CASE WHEN class = 20 THEN (dboy+dgirl+bboy+bgirl) END),0) Special_Class,
IFNULL(MAX(CASE WHEN class = 21 THEN (dboy+dgirl+bboy+bgirl) END),0) OC,

sum(dboy) + sum(dgirl) + sum(bboy) + sum(bgirl) as "Grand Total"

FROM studentstrength ss 
inner join staffhead on ss.typeid = staffhead.schooltype 
inner join school on staffhead.schoolid = school.SchoolID

where staffhead.deadline='2015-12-31'
GROUP By school.SchoolName
ORDER BY school.sortby ASC 



//Final School_wise_staff Query

SELECT SchoolName,
IFNULL(MAX(CASE WHEN designationid = 1 THEN (Female+Male) END),0) Principal,
IFNULL(MAX(CASE WHEN designationid = 2 THEN (Female+Male) END),0) Rector,
IFNULL(MAX(CASE WHEN designationid = 3 THEN (Female+Male) END),0) Director,
IFNULL(MAX(CASE WHEN designationid = 4 THEN (Female+Male) END),0) Headmaster,
IFNULL(MAX(CASE WHEN designationid = 5 THEN (Female+Male)END),0) PGTNotTibetanLang,
IFNULL(MAX(CASE WHEN designationid = 6 THEN (Female+Male) END),0) TGTNotTibetanLang,
IFNULL(MAX(CASE WHEN designationid = 7 THEN (Female+Male) END),0) PGTTibetanLang,
IFNULL(MAX(CASE WHEN designationid = 8 THEN (Female+Male) END),0) TGTTibetanLang,
IFNULL(MAX(CASE WHEN designationid = 9 THEN (Female+Male) END),0) PRT,
IFNULL(MAX(CASE WHEN designationid = 10 THEN (Female+Male) END),0) PrePrimaryTeacher,
IFNULL(MAX(CASE WHEN designationid = 11 THEN (Female+Male) END),0) CulturalTeacher,
IFNULL(MAX(CASE WHEN designationid = 12 THEN (Female+Male) END),0) ComputerTeacher,
IFNULL(MAX(CASE WHEN designationid = 13 THEN (Female+Male) END),0) WoodCraftTeacher,
IFNULL(MAX(CASE WHEN designationid = 14 THEN (Female+Male) END),0) Tailoring,
IFNULL(MAX(CASE WHEN designationid = 15 THEN (Female+Male) END),0) PhysicalEducation,
IFNULL(MAX(CASE WHEN designationid = 16 THEN (Female+Male) END),0) Drawing,
IFNULL(MAX(CASE WHEN designationid = 17 THEN (Female+Male) END),0) DanceMusic,
IFNULL(MAX(CASE WHEN designationid = 18 THEN (Female+Male) END),0) NonTeachingStaff,
IFNULL(MAX(CASE WHEN designationid = 19 THEN (Female+Male) END),0) Tibetanstaff,
IFNULL(MAX(CASE WHEN designationid = 20 THEN (Female+Male) END),0) NonTibetanStaff,
IFNULL(MAX(CASE WHEN designationid = 21 THEN (Female+Male) END),0) Librarian,
IFNULL(MAX(CASE WHEN designationid = 22 THEN (Female+Male) END),0) CareerCounselar,
IFNULL(MAX(CASE WHEN designationid = 23 THEN (Female+Male) END),0) Supervisor,
IFNULL(MAX(CASE WHEN designationid = 24 THEN (Female+Male) END),0) ChineseLanguageTeacher,
IFNULL(MAX(CASE WHEN designationid = 25 THEN (Female+Male) END),0) ReligiousTeacher,
TRUNCATE((sum(Female) + sum(Male)) / 2,0) as 'Grand Total'

FROM staffstrength ss 
inner join staffhead on ss.schoolinfo = staffhead.schooltype 
inner join school on staffhead.schoolid = school.SchoolID

where staffhead.deadline='2015-12-31'
GROUP By school.SchoolName
ORDER BY school.sortby ASC



//Result Generation
SELECT 
	SchoolCategoryName, 
	SchoolName, 
	IFNULL(totstu,0) Total, 
	IFNULL(stuappear,0) Appeared, 
	IFNULL(stupromoted,0) Pass, 
	IFNULL(sturetain,0) Fail,
    TRUNCATE((stupromoted/stuappear) * 100,2) AS PassPercentage,
    IFNULL(TRUNCATE((sturetain/stuappear) * 100,2),0) AS FailPercentage,
	school.sortby, 
	staffhead.deadline 

FROM 
	(
		schoolcategory 
		INNER JOIN school ON schoolcategory.SchoolCategoryId = school.SchoolCategoryId
	) 
	INNER JOIN (
		genresult 
		INNER JOIN staffhead ON genresult.schooltype = staffhead.schooltype
	) ON school.SchoolID = staffhead.schoolid 
WHERE 
	(
		(
			(staffhead.deadline)= '2015-12-31'
		)
	) 
ORDER BY 
	school.sortby

//School Category Wise Student Enrollment

select 
	schoolcategory.schoolcatname, 
	schoolcategory.SchoolCategoryName, 
	school.SchoolName, 
	sum(studentstrength.tboy) as 'tibetanboys', 
	sum(studentstrength.tgirl) as 'tibetangirls', 
	sum(tboy) + sum(tgirl) as 'total1', 
	sum(studentstrength.hboy) as 'himalayanboys', 
	sum(studentstrength.hgirl) as 'himalayangirls', 
	sum(hboy) + sum(hgirl) as 'total2', 
	sum(studentstrength.nboy) as 'Indianboys', 
	sum(studentstrength.ngirl) as 'Indiangirls', 
	sum(nboy) + sum(ngirl) as 'total3', 
	sum(studentstrength.dboy) as 'Dayboys', 
	sum(studentstrength.dgirl) as 'Daygirls', 
	sum(dboy) + sum(dgirl) as 'total4', 
	sum(studentstrength.bboy) as 'boardingboys', 
	sum(studentstrength.bgirl) as 'boardinggirls', 
	sum(bboy) + sum(bgirl) as 'total5', 
	sum(dboy) + sum(bboy) as 'TotalBoy', 
	sum(dgirl) + sum(bgirl) as 'TotalGirl', 
	sum(dboy) + sum(bboy) + sum(dgirl) + sum(bgirl) as 'Grand Total', 
	staffhead.deadline 
from 
	studentstrength 
	inner join (
		staffhead 
		INNER JOIN(
			schoolcategory 
			INNER JOIN school ON schoolcategory.SchoolCategoryId = school.SchoolCategoryId
		) ON staffhead.schoolid = school.SchoolID
	) ON studentstrength.typeid = staffhead.schooltype 
where 
	staffhead.deadline = '2015-12-31' AND	schoolCategory.SchoolCategoryId = '2'
GROUP by 
	schoolcategory.schoolcatname, 
	schoolcategory.SchoolCategoryName, 
	school.SchoolName, 
	school.sortby, 
	school.status 
order by 
	school.sortby ASC


	//Female and Male Count

SELECT sum(Female)
FROM staffstrength INNER JOIN staffhead on staffstrength.schoolinfo = staffhead.schooltype
where designationid = '18' AND staffhead.deadline = '2015-12-31'










