<!-- load css -->
<link rel="stylesheet" href="<?php echo $assetUrl;?>/css/recruit.css?<?php echo VERHASH;?>">
<link rel="stylesheet" href="<?php echo STATICURL;?>/js/lib/autoComplete/jquery.autocomplete.css?<?php echo VERHASH;?>">
<!-- load css end-->

<!-- Mainer -->
<div class="wrap">
    <div class="mc clearfix">
        <!-- Sidebar -->
        <?php echo $sidebar;?>
        <!-- Sidebar end -->

        <!-- Mainer right -->
        <div class="mcr">
            <!-- Mainer nav -->
            <div class="page-list">
                <div class="page-list-header">
                    <div class="btn-toolbar pull-left">
                        <button class="btn btn-primary pull-left" data-click="addBgcheck"><?php echo $lang["Add"];?></button>
                        <div class="btn-group" id="art_more" style="display:block;">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <?php echo $lang["More operation"];?>
                                <i class="caret"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="javascript:;" data-click="deleteBgchecks">
                                        <?php echo $lang["Delete"];?>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;" data-click="exportBgcheck">
                                        <?php echo $lang["Export"];?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <form  action="<?php echo $this->createUrl("bgchecks/search");?>" method="post">
                        <div class="search search-config pull-right span3">
                            <input type="text" placeholder="Search"  id="mn_search" name="keyword" nofocus>
                            <a href="javascript:;">search</a>
                            <input type="hidden" name="type" value="normal_search">
                        </div>
                    </form>
                </div>
                <div class="page-list-mainer">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="20">
                                    <label class="checkbox">
                                        <input type="checkbox" name="" data-name="bgcheck[]" id="all_select">
                                    </label>
                                </th>
                                <th width="70">
                                    <?php echo $lang["Name"];?>
                                </th>
                                <th width="100"><?php echo $lang["Work unit"];?></th>
                                <th width="70"><?php echo $lang["Position"];?></th>
                                <th width="70"><?php echo $lang["Entry time"];?></th>
                                <th width="70"><?php echo $lang["Departure time"];?></th>
                                <th width="100"><?php echo $lang["Operation"];?></th>
                            </tr>
                        </thead>
                        <tbody id="bgchecks_tbody">
                            <?php foreach ($resumeBgchecksList as $bgchecks ) : ?>
                                <tr>
                                    <td>
                                        <label class="checkbox">
                                            <input type="checkbox" name="bgcheck[]" value="<?php echo $bgchecks["checkid"];?>">
                                        </label>
                                    </td>
                                    <td>
                                        <a href="<?php echo $this->createUrl("resume/show", array("resumeid" => $bgchecks["resumeid"]));?>"><?php echo $bgchecks["realname"];?></a>
                                    </td>
                                    <td>
                                        <?php echo 	$bgchecks["company"];?>
                                    </td>
                                    <td>
                                        <?php echo $bgchecks["position"];?>
                                    </td>
                                    <td>
                                        <?php echo $bgchecks["entrytime"];?>
                                    </td>
                                    <td>
                                        <?php echo $bgchecks["quittime"];?>
                                    </td>
                                    <td>
                                        <a href="javascript:" data-click="editBgcheck" data-id="<?php echo $bgchecks["checkid"];?>" title="<?php echo $lang["Modify"];?>" class="cbtn o-edit"></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
					<div class="no-data-tip" <?php if (0 < count($resumeBgchecksList)) echo ' style="display:none" '; ?> id="no_bgchecks_tip"></div>
                </div>
                <div class="page-list-footer">
                    <div class="pull-right">
                        <?php $this->widget("IWPage", array("pages" => $pagination));?>
                    </div>
                </div>
            </div>
            <!-- Mainer content -->
        </div>
    </div>
</div>
<!-- 高级搜索 -->
<div id="mn_search_advance" style="width: 400px; display:none;">
    <form id="mn_search_advance_form" action="<?php echo $this->createUrl("bgchecks/search");?>" method="post">
        <div class="form-horizontal form-compact">
            <div class="control-group">
                <label for="" class="control-label"><?php echo $lang["Name"];?></label>
                <div class="controls">
                    <input type="text" id="realname" name="search[realname]">					
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label"><?php echo $lang["Company name"];?></label>
                <div class="controls">
                    <input type="text" id="company" name="search[company]">					
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label"><?php echo $lang["Position"];?></label>
                <div class="controls">
                    <input type="text" id="position" name="search[position]">					
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label"><?php echo $lang["Entry time"];?></label>
                <div class="controls">
                    <div class="datepicker" id="date_time">
                        <a href="javascript:;" class="datepicker-btn"></a>
                        <input type="text" class="datepicker-input" name="search[entrytime]">
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label"><?php echo $lang["Departure time"];?></label>
                <div class="controls">
                    <div class="datepicker" id="date_time2">
                        <a href="javascript:;" class="datepicker-btn"></a>
                        <input type="text" class="datepicker-input" name="search[quittime]">
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="type" value="advanced_search">
    </form>
</div>

<!--增加/修改背景记录-->
<div id="bgcheck_dialog" style="width: 500px; display:none;">
    <form id="bgcheck_dialog_form" method="get">
		<div class="form-horizontal form-compact">
			<div class="control-group" id="r_fullname">
				<label for="" class="control-label"><?php echo $lang["Candidates"];?></label>
				<div class="controls">
					<input type="text" name="fullname" id="fullname" class="span6">
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label"><?php echo $lang["Work unit"];?></label>
				<div class="controls">
					<input id="bgcompany" type="text" name="company" value="" class="span6">
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label"><?php echo $lang["Contact people"];?></label>
				<div class="controls">
					<input id="bgcontact" type="text" name="contact" value="" class="span6">
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label"><?php echo $lang["Telephone"];?></label>
				<div class="controls">
					<input id="phone" type="text" name="phone" value="" class="span6">
				</div>	
			</div>
			<div class="control-group">
				<label for="" class="control-label"><?php echo $lang["Office time"];?></label>
				<div class="controls">
                    <div class="row">
    					<div class="span6">
                            <div class="datepicker input-group" id="entrytime_datepicker">
                                <span class="input-group-addon">从</span>
                                <a href="javascript:;" class="datepicker-btn"></a>
                                <input type="text" class="datepicker-input" id="entrytime" name="entrytime">
                            </div>
    					</div>
    					<div class="span6">
                             <div class="datepicker input-group" id="quittime_datepicker">
                                <span class="input-group-addon">至</span>
                                <a href="javascript:;" class="datepicker-btn"></a>
                                <input type="text" class="datepicker-input" id="quittime" name="quittime">
                            </div>
    					</div>
                    </div>
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label"><?php echo $lang["Post office"];?></label>
				<div class="controls">
					<input id="bgposition" type="text" name="position" value="" class="span6">
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label"><?php echo $lang["Details"];?></label>
				<div class="controls">
					<textarea name="detail" id="bgdetail" rows="4" cols="20"></textarea>
				</div>
			</div>
		</div>
        <input type="hidden" name="checkid" id="checkid" />
    </form>
</div>

<!-- 插入背景信息模板 -->
<script type="text/ibos-template" id="bgchecks_template">
<tr>
    <td>
        <label class="checkbox">
           <input type="checkbox" value="<%=checkid%>" name="bgcheck[]">
        </label>
    </td>
    <td>
        <%=fullname%>
    </td>
    <td>
        <%=company%>
    </td>
    <td>
        <%=position%>
    </td>
    <td>
        <%=entrytime%>
    </td>
    <td>
        <%=quittime%>
    </td>
    <td>
        <a href="javascript:" data-click="editBgcheck" data-id="<%=checkid%>" title="<?php echo $lang["Update"];?>" class="cbtn o-edit"></a>
    </td>
</tr>
</script>

<script>
    var PAGE_PARAM = {
        BGCHECK_DELETE_URL: "<?php echo $this->createUrl("bgchecks/del");?>",
        BGCHECK_EDIT_URL:   "<?php echo $this->createUrl("bgchecks/edit", array("op" => "getEditData"));?>",
        BGCHECK_UPDATE_URL: "<?php echo $this->createUrl("bgchecks/edit", array("op" => "update"));?>",
        BGCHECK_SAVE_URL:   "<?php echo $this->createUrl("bgchecks/add");?>",
		BGCHECK_EXPORT_URL: "<?php echo $this->createUrl("bgchecks/export");?>"
    }
</script>
<script src='<?php echo STATICURL;?>/js/lib/formValidator/formValidator.packaged.js?<?php echo VERHASH;?>'></script>
<script src='<?php echo $assetUrl;?>/js/lang/zh-cn.js?<?php echo VERHASH;?>'></script>
<script src='<?php echo $assetUrl;?>/js/recruit.js?<?php echo VERHASH;?>'></script>
<script>
    var resumes = <?php echo $resumes;?>;
    $(function() {
        //输入简历姓名自动完成
//        $('#fullname').autocomplete(resumes, {
//            max: 10,    //列表里的条目数
//            minChars: 0,    //自动完成激活之前填入的最小字符
//            width: 398,     //提示的宽度，溢出隐藏
//            scrollHeight: 300,   //提示的高度，溢出显示滚动条
//            matchContains: true,    //包含匹配，就是data参数里的数据，是否只要包含文本框里的数据就显示
//            autoFill: true,    //自动填充
//            formatItem: function(row, i, max) {
//                var sex;
//                if ( row.gender == 1 ) {
//                    sex = "";
//                } else if ( row.gender == 2 ) {
//                    sex = "";
//                } else {
//                    sex = "";
//                }
//                return row.realname + '  ' + sex + "  [ ":" + row.targetposition + ' ]';
//            },
//             formatMatch: function(row, i, max) {
//                return row.realname;
//            },
//            formatResult: function(row) {
//                return row.realname;
//            }
//        }).result(function(event, row, formatted) {
//            $('#resumeid').val(row.resumeid);
//        });


         //验证用户名是否存在于简历表
        $.formValidator.initConfig({ formID:"form_add_bgcheck", errorFocus:true});
		$("#fullname").formValidator()
		.inputValidator({
			min:1,
			onError: U.lang("REC.PLEASE_FILL_IN_THE_NAME_OF_EXISTING_RESUME")
		})
		.ajaxValidator({
			type : 'get',
			datatype : "json",
			async : true,
			url : Ibos.app.url('recruit/contact/checkRealname'),
			success : function(res){
				var isExist = $.parseJSON(res);
				return !!isExist.statu;
			},
			buttons: $(".btn btn-primary"),
			onError : U.lang("REC.THIS_NAME_DOSNOT_EXIT_RESUME")
		});
        
        //高级搜索
        $("#mn_search").search(null, function(){
            Ui.dialog({
                id: "d_advance_search",
                title: U.lang("ADVANCED_SETTING"),
                content: document.getElementById("mn_search_advance"),
                cancel: true,
                init: function(){
                    var form = this.DOM.content.find("form")[0];
                    form && form.reset();
                    // 初始化日期选择
                    $("#date_time").datepicker({ target: $("#date_time2") });
                },
                ok: function(){
                    this.DOM.content.find("form").submit();
                },
            })
        })
    });
</script>