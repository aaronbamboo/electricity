/* 创建工程项目信息表 */
create table ctcdb.ctc_projectinfo (
    project_id INT not null auto_increment,
    project_aera varchar(12) not null, 
    project_name varchar(128) not null,
    project_code varchar(32),
    site_code varchar(32), 
    constr_type varchar(12),
    constr_detail varchar(32),
    yd_pc varchar(24),
    dx_pc varchar(24),
    lt_pc varchar(24),
    pro_status int default 0,  /* 0-4:未落实，落实，开工，完工，交付 */
    remark varchar(128),  /* 备注信息 */
    primary key (project_id)
);

/* 创建项目交付进度计划表 */
create table ctcdb.ctc_projectplan (
    plan_id INT not null auto_increment,
    project_id INT not null,
    plan_date date,
    done_date date,
    last_date date,
    remark varchar(128),
    primary key (plan_id),
    constraint foreign key (project_id) references ctc_projectinfo(project_id)
)


/* 测试数据 */
insert into ctc_projectinfo  (project_aera, project_name,project_code, site_code, constr_type, constr_detail,
yd_pc, dx_pc, lt_pc, pro_status) 
values ('越城区', '绍兴袍江苏泊尔','ZJSX001', '10001', '新建', '两家新建', '', '', '联通1', 4);
insert into ctc_projectinfo  (project_aera, project_name,project_code, site_code, constr_type, constr_detail,
yd_pc, dx_pc, lt_pc, pro_status) 
values ('越城区', '绍兴袍江加多宝','ZJSX002', '10002', '新建', '独家新建', '移动2', '', '', 2);
insert into ctc_projectinfo  (project_aera, project_name,project_code, site_code, constr_type, constr_detail,
yd_pc, dx_pc, lt_pc, pro_status) 
values ('诸暨市', '诸暨城关东一路北','ZJSX03', '10003', '新建', '独家新建',  '移动1', '', '',3);

