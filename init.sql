create database "website_statistics"
       with owner "postgres"
       encoding 'UTF8';

\c website_statistics;

grant all privileges on database website_statistics to postgres;

create table "public".visits (
  id serial primary key,
  visitor varchar(105) not null,
  visits_count integer not null,
  date timestamp not null
);

insert into visits (visitor, visits_count, date) values ('John Doe', 10, '2020-04-09 10:10');
insert into visits (visitor, visits_count, date) values ('John Doe', 20, '2020-03-09 10:10');
insert into visits (visitor, visits_count, date) values ('John Doe', 1, '2020-02-09 10:10');
insert into visits (visitor, visits_count, date) values ('John Doe', 5, '2020-01-09 10:10');
insert into visits (visitor, visits_count, date) values ('John Doe', 4, '2020-31-03 10:10');
insert into visits (visitor, visits_count, date) values ('John Doe', 9, '2020-13-03 10:10');