/* 创建工程项目信息表 */
create table ctc_projectinfo (
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
create table ctc_projectplan (
    plan_id INT not null auto_increment,
    project_id INT not null,
    plan_date date,
    done_date date,
    last_date date,
    remark varchar(128),
    primary key (plan_id),
    constraint foreign key (project_id) references ctc_projectinfo(project_id)
);

create table ctc_dcload (
    dc_id INT not null auto_increment,
    site_area varchar(12) not null,  -- 1,越城;2,柯桥;3,诸暨;4,上虞;5,嵊州;6,新昌
    site_code varchar(32),
    site_name varchar(32),
    share_info varchar(16),
    meter_user varchar(16),
    yd_dcload float,
    lt_dcload float,
    dx_dcload float,
    remark varchar(64),
    primary key (dc_id)
);

CREATE INDEX id_ctc_dcload_sitecode ON ctc_dcload (site_code);


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

insert into ctc_dcload (site_area, site_code, site_name, share_info, meter_user, yd_dcload, lt_dcload, dx_dcload) 
values ('越城', 'SXYC00001', '绍兴袍江苏泊尔', '移动', '移动', 35,0,0);
insert into ctc_dcload (site_area, site_code, site_name, share_info, meter_user, yd_dcload, lt_dcload, dx_dcload) 
values ('越城', 'SXYC00002', '绍兴皋埠南岸北', '电信', '电信', 0,0,20);
insert into ctc_dcload (site_area, site_code, site_name, share_info, meter_user, yd_dcload, lt_dcload, dx_dcload) 
values ('柯桥', 'SXYC00003', '柯桥柯桥金汇大厦', '移动+联通', '移动', 35,20,0);


