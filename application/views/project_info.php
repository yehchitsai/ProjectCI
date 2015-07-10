<!-------------------------------------start-------------------------------------------------->  

<div class="container">
    <div id="mainSelect" class="well span10">
        <form action ="register" method ="post" enctype="multipart/form-data">
            <input type ="hidden" name ="action" value ="finish" />
            <fieldset>
                <legend>專題資訊</legend>
                <div class="control-group p_year">
                    <label class="control-label" for="inputError">專題資訊</label>
                    <div class="controls">
                        <table width="381" border="1">
							<tr>
							  <th width="125">專題名稱：</th><td width="240">{p_name}</td>
							</tr>
							<tr>
							  <th>專題級別：</th><td>{enter_year}</td>
							</tr>
							<tr>
							  <th>專題教授：</th><td>{p_adviser}</td>
							</tr>
							<tr>
							  <th>專題組長：</th><td>{p_leader_name}</td>
							</tr>
							<tr>
							  <th>專題組員：</th><td>{proj_members}</td>
							</tr>
							<tr>
							  <th>專題類別：</th><td>{p_type}</td>
							</tr>
							<tr>
							  <th>專題上傳日期：</th><td>{p_date}</td>
							</tr>
							<tr>
							  <th>專題摘要：</th><td>{p_description}</td>
							</tr>
						  </table>
                        <span class="help-inline"></span>
                    </div>
                </div>	
				<hr>	
                <div class="control-group p_name">
                    <label class="control-label" for="inputError">得獎紀錄</label>
                    <div class="controls">
                        <table width="384" border="1">
							<tr>
							  <th width="100">類型</th><th width="251">比賽紀錄</th>
							</tr> 
							{award_entries}
							<tr>							 
								<td>{a_type}</td>
								<td><a href="{baseURL}upload/{a_url}">{a_name}</a></td>
							</tr>
							{/award_entries}
						  </table>
                    </div>
                </div>
				<hr>
                <div class="control-group p_adviser">
                    <label class="control-label" for="inputError">檢驗狀態</label>
                    <div class="controls">
                         <input type="submit" name="button" id="button" value="檢驗" disabled />  
                        <span class="help-inline"></span>
                    </div>
                </div>
				<hr>
                <div class="control-group p_type">
                    <label class="control-label" for="inputError">產生驗證碼</label>
                    <div class="controls">
                       <input type="submit" name="button2" id="button2" value="產生驗證碼" disabled />
                        <span class="help-inline"></span>
                    </div>
                </div>
               
            </fieldset>
        </form>
    </div>
</div>
<!-------------------------------------end-------------------------------------------------->  
