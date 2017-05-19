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




select school.sortby,school.SchoolName,sum(dboy) + sum(bboy) + sum(dgirl) + sum(bgirl) as "Student", 
staffhead.deadline from studentstrength inner join staffhead ON studentstrength.typeid = staffhead.schooltype INNER JOIN school on school.SchoolID = staffhead.schoolid where staffhead.deadline='2013-12-31' GROUP by school.SchoolName order by school.sortby ASC



select school.SchoolName,sum(dboy) + sum(bboy) + sum(dgirl) + sum(bgirl) as "Grand Total",
staffhead.deadline from studentstrength inner join staffhead ON studentstrength.typeid = staffhead.schooltype INNER JOIN school on school.SchoolID = staffhead.schoolid INNER JOIN staffstrength on staffstrength.schoolinfo = studentstrength.typeid where staffhead.deadline='2006-12-31' GROUP by school.SchoolName order by school.sortby ASC