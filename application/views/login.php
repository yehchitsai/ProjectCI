<!-------------------------------------start-------------------------------------------------->  

<div class="container">
    <div id="mainSelect" class="well span10">
        <form action ="login" method ="post" >
            <input type ="hidden" name ="action" value ="finish" />
            <fieldset>
                <legend>老師/學生登入</legend>
				<div>				
					<select name="sel" id="select" >
					   <option value="0" >--請選擇--</option>
					   <option value="1" id="teacher">教師</option>
					   <option value="2" id="student" selected>學生</option>
					</select>
				</div>
                <div class="control-group account">
                    <label class="control-label" for="inputError" >帳號</label>
                    <div class="controls">
                        <input type="text" id ="account" value="">
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="control-group password">
                     <label class="control-label" for="inputError" >密碼</label>
                    <div class="controls">
                        <input type="password" id ="password" value="">
                        <span class="help-inline"></span>
                    </div>
                </div>
                
                <button type="button" class="btn" id ="submit">登入</button>
            </fieldset>
        </form>
    </div>
</div>


<!-------------------------------------end-------------------------------------------------->  
