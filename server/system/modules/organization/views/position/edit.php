<!-- private css -->
<link rel="stylesheet" href="<?php echo $assetUrl; ?>/css/organization.css?<?php echo VERHASH; ?>">
<div class="mc clearfix">
	<!-- Sidebar goes here-->
	<?php echo $this->getSidebar( array( 'lang' => $lang ) ); ?>
	<!-- Mainer right -->
	<div class="mcr">
		<form class="form-horizontal" method="post" id="position_edit_form">
			<div class="ct ctform">
				<div class="row mb">
					<div class="span4">
						<label><?php echo $lang['Sort number']; ?></label>
						<input type="text" name="sort" id="order_id" value="<?php echo $pos['sort']; ?>" />
					</div>
					<div class="span4">
						<label><?php echo $lang['Position name']; ?></label>
						<input type="text" name="posname" id="pos_name" value="<?php echo $pos['posname']; ?>" />
					</div>
					<div class="span4">
						<label><?php echo $lang['Position category']; ?></label>
						<select name="catid">
							<?php echo $category; ?>
						</select>
					</div>
				</div>
			</div>
			<div>
				<div>
					<ul class="nav nav-tabs nav-tabs-large nav-justified" id="org_position_tab">
						<li class="active">
							<a href="#limit_setup" data-toggle="tab"><?php echo $lang['Permissions setup']; ?></a>
						</li>
						<li>
							<a href="#position_instruction" data-toggle="tab"><?php echo $lang['Position instruction']; ?></a>
						</li>
						<li>
							<a href="#position_member" data-toggle="tab"><?php echo $lang['Position member']; ?></a>
						</li>
					</ul>
					<div class="tab-content bdrb">
						<!-- 权限设置 -->
						<div id="limit_setup" class="ct org-limit org-limit-setup tab-pane active">
							<!-- 认证项输出 begin -->
							<?php foreach ( $authItem as $key => $auth ) : ?>
								<div class="org-limit-box">
									<div class="org-limit-header">
										<button type="button" class="btn btn-small j-limit-checkall pull-right"  data-node="cateCheckbox" data-id="<?php echo $key; ?>">全选</button>
										<h4><?php echo $auth['category']; ?></h4>
									</div>
									<div class="org-limit-body fill">
										<?php if ( isset( $auth['group'] ) ): ?>
											<?php foreach ( $auth['group'] as $gKey => $group ) : ?>
												<div class="org-limit-entry">
													<label class="checkbox">
														<input type="checkbox" data-id="<?php echo $gKey; ?>"  data-node="modCheckbox" data-pid="<?php echo $key; ?>">
														<?php echo $group['groupName']; ?>
													</label>
												</div>
												<ul class="org-limit-list clearfix">
													<?php foreach ( $group['node'] as $nIndex => $node ): ?>
														<?php $isData = $node['type'] === 'data';
														$checked = isset( $related[$node['module']][$node['key']] ); ?>
														<li <?php if ( $isData ): ?>class="org-limit-privilege-wrap"<?php endif; ?>>
															<label <?php if ( $checked ): ?>class="active"<?php endif; ?>>
																<input <?php if ( $checked ): ?>checked<?php endif; ?> type="checkbox" name="nodes[<?php echo $node['id']; ?>]" value="<?php echo $isData ? 'data' : $node['id']; ?>" data-node="funcCheckbox" data-pid="<?php echo $gKey; ?>">
																	<?php if ( $isData ): ?>
																	<div class="org-limit-privilege">
																		<?php foreach ( $node['node'] as $dIndex => $data ): ?>
																		<?php $checked = isset( $related[$data['module']][$data['key']][$data['node']] ); ?>
																			<input value="<?php echo $checked ? $related[$data['module']][$data['key']][$data['node']] : ''; ?>" <?php if ( $checked ): ?>checked<?php endif; ?> name="data-privilege[<?php echo $node['id']; ?>][<?php echo $data['id']; ?>]" type="text" data-text="<?php echo $data['name']; ?>" data-toggle="privilegeLevel">
																	<?php endforeach; ?>
																	</div>
																	<?php endif; ?>
																<div <?php if ( $isData ): ?>style="width: 40px;"<?php endif; ?>><?php echo $node['name']; ?></div>
															</label>
														</li>
												<?php endforeach; ?>
												</ul>
											<?php endforeach; ?>
											<?php else: ?>
											<ul class="org-limit-list clearfix">
												<?php foreach ( $auth['node'] as $nIndex => $node ): ?>
												<?php $isData = $node['type'] === 'data';$checked = isset( $related[$node['module']][$node['key']] ); ?>
													<li <?php if ( $isData ): ?>class="org-limit-privilege-wrap"<?php endif; ?>>
														<label <?php if ( $checked ): ?>class="active"<?php endif; ?>>
															<input <?php if ( $checked ): ?>checked<?php endif; ?> type="checkbox" name="nodes[<?php echo $node['id']; ?>]" value="<?php echo $isData ? 'data' : $node['id']; ?>" data-pid="<?php echo $key; ?>">
																<?php if ( $isData ): ?>
																<div class="org-limit-privilege">
																	<?php foreach ( $node['node'] as $dIndex => $data ): ?>
																		<?php $checked = isset( $related[$data['module']][$data['key']][$data['node']] ); ?>
																		<input value="<?php echo $checked ? $related[$data['module']][$data['key']][$data['node']] : ''; ?>" <?php if ( $checked ): ?>checked<?php endif; ?> type="text" name="data-privilege[<?php echo $node['id']; ?>][<?php echo $data['id']; ?>]" data-text="<?php echo $data['name']; ?>" data-toggle="privilegeLevel">
																<?php endforeach; ?>
																</div>
																<?php endif; ?>
													<?php echo $node['name']; ?>
														</label>
													</li>
													<?php endforeach; ?>
											</ul>
											<?php endif; ?>
									</div>
								</div>
							<?php endforeach; ?>
							<div class="fill">
								<img src="<?php echo $assetUrl; ?>/image/illustrate.png" alt="权限说明图解">
							</div>
							<!-- 认证项输出 end -->
						</div>
						<!-- 岗位说明书 -->
						<div id="position_instruction" class="ct tab-pane">
							<div class="form-horizontal form-compact">
								<div class="control-group fill bdbs">
									<label class="control-label"><strong><?php echo $lang['Position target']; ?></strong></label>
									<div class="controls">
										<textarea name="goal" rows="5"><?php echo $pos['goal']; ?></textarea>
									</div>
								</div>
								<div class="control-group fill">
									<label class="control-label"><strong><?php echo $lang['Minimum requirements']; ?></strong></label>
									<div class="controls">
										<textarea name="minrequirement" rows="5"><?php echo $pos['minrequirement']; ?></textarea>
									</div>
								</div>
							</div>
							<div class="page-list">
								<div class="page-list-mainer">
									<table class="table org-ins-table bdpt" id="org_ins_table">
										<thead>
											<tr>
												<th width="40"></th>
												<th><?php echo $lang['Responsibility']; ?></th>
												<th><?php echo $lang['Criteria']; ?></th>
												<th width="40"></th>
											</tr>
										</thead>
										<tbody>
										<?php if ( !empty( $responsibility ) ): ?>
											<?php foreach ( $responsibility as $key => $value ) : ?>
													<tr>
														<td width="40"><span class="badge" data-toggle="badge"><?php echo $key+1; ?></span></td>
														<td><input type="text" name="responsibility[<?php echo $value['id']; ?>]" value="<?php echo $value['responsibility']; ?>"></td>
														<td><input type="text" name="criteria[<?php echo $value['id']; ?>]" value="<?php echo $value['criteria']; ?>"></td>
														<td width="40"><a href="javascript:;" data-id="<?php echo $value['id']; ?>" class="cbtn o-trash"></a></td>
													</tr>
											<?php endforeach; ?>
										<?php endif; ?>
										</tbody>
										<tfoot>
											<tr>
												<td></td>
												<td colspan="4">
													<a href="javascript:;" class="add-one" id="org_ins_add">
														<i class="cbtn o-plus"></i>
														<?php echo $lang['Add one']; ?>
													</a>
												</td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
						<!-- 岗位成员 -->
						<div id="position_member" class="ct tab-pane">
							<div class="fill">
								<ul class="org-member-list clearfix" id="org_member_list">
									<?php if(isset($uids)): ?>
									<?php $depts = DepartmentUtil::loadDepartment();?>
									<?php foreach ( $uids as $uid ): ?>
										<?php 										
										$user = User::model()->fetchByUid($uid); 
										if ( empty( $user ) ){ 
											continue;
										}
										?>
										<li id="member_u_<?php echo $uid; ?>">
											<a href="javascript:;" class="cbtn o-trash pull-right" data-act="removeMember" data-id="u_<?php echo $uid; ?>"></a>
											<div class="avatar-box">
												<a href="javascript:;" class="avatar-circle"><img src="avatar.php?uid=<?php echo $user['uid']; ?>&engine=<?php echo ENGINE; ?>" alt=""></a>
											</div>
											<div class="org-member-item-body">
												<p class="xcn xwb"><?php echo $user['realname']; ?></p>
												<p class="tcm"><?php echo $user['deptid'] ? $depts[$user['deptid']]['deptname'] : '--'; ?></p>
											</div>
										</li>
									<?php endforeach; ?>
									<?php endif; ?>
									<li class="org-member-add" id="org_member_add">
										<a href="jaascript:;">
											<i class="cbtn o-plus"></i>
											<span class="dib mlm"><?php echo $lang['Add member']; ?></span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="clearfix xar fill">
						<button type="submit" name="posSubmit" class="btn btn-large btn-submit btn-primary pull-right"><?php echo $lang['Save']; ?></button>
					</div>
				</div>
				<input type="hidden" name="resDelId" id="res_del_id" />
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<input type="hidden" name="member" id="member" value="<?php echo isset($uids) ? implode( ',', array_map( function($id) {return  'u_' . $id;}, $uids)) : ''; ?>" />
		</form>
	</div>
</div>
<div id="member_select_box"></div>
<script type="text/template" id="org_ins_tpl">
	<tr>
	<td width="40"><span class="badge" data-toggle="badge"><%=id%></span></td>
	<td><input type="text" name="newResponsibility[]" value="<%=val%>"></td>
	<td><input type="text" name="newCriteria[]"></td>
	<td width="40"><a href="javascript:;" class="cbtn o-trash"></a></td>
	</tr>
</script>
<!-- 新增成员模板  -->
<script type="text/template" id="org_member_tpl">
	<li id="member_<%=id%>">
	<a href="javascript:;" class="cbtn o-trash pull-right" data-act="removeMember" data-id="<%=id%>"></a>
	<div class="avatar-box">
	<a href="javascript:;" class="avatar-circle"><img src="<%=imgurl%>" alt=""></a>
	</div>
	<div class="org-member-item-body">
	<p class="xcn xwb"><%=user%></p>
	<p class="tcm"><%=department%></p>
	</div>
	</li>
</script>
<script src='<?php echo STATICURL; ?>/js/lib/formValidator/formValidator.packaged.js?<?php echo VERHASH; ?>'></script>
<script src='<?php echo $assetUrl; ?>/js/lang/zh-cn.js?<?php echo VERHASH; ?>'></script>
<script src='<?php echo $assetUrl; ?>/js/organization.js?<?php echo VERHASH; ?>'></script>
<script src='<?php echo $assetUrl; ?>/js/org_position_edit.js?<?php echo VERHASH; ?>'></script>
<script>
	(function() {
		// 岗位成员列表
		Organization.memberList.init([<?php echo isset($uidString) ? $uidString : ''; ?>]);
	})();
</script>