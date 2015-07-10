<!-------------------------------------start-------------------------------------------------->  

<div class="container">
    <div id="mainSelect" class="well span10">
        <form action ="register" method ="post" >
            <input type ="hidden" name ="action" value ="finish" />
            <fieldset>
                <legend>專題註冊</legend>
                <div class="control-group p_name">
                    <label class="control-label" for="inputError">專題名稱</label>
                    <div class="controls">
                        <input type="text" id ="project_name">
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="control-group p_adviser">
                    <label class="control-label" for="inputError">指導教授</label>
                    <div class="controls">
                        <select id ="sel_teacher" >
                            <option value ="-1">請選擇</option>
                        </select>    
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="control-group p_type">
                    <label class="control-label" for="inputError">專題類型</label>
                    <div class="controls">
                        <select id ="project_type">
                            <option selected ="selected">請選擇</option>
                            <option>論文類</option>
                            <option>系統類</option>
                            <option>模擬類</option>
                            <option>管理類</option>
                        </select>
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="control-group p_description">
                    <label class="control-label" for="inputError">專題描述</label>
                    <div class="controls">
                        <textarea row ="3" id ="project_description"></textarea>
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="control-group p_keyword">
                    <label class="control-label" for="inputError">關鍵字</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" placeholder="ex : android,影像辨識,行動裝置" id ="project_keyword">
                        <span class="help-inline"></span>
                    </div>
                </div>
                <span class="help-block">注意! 如果關鍵字為 android 影像辨識 行動裝置三個<br/>則輸入的格式為android,影像辨識,行動裝置</span>
                <hr/>
                <div class="control-group p_leader_name">
                    <label class="control-label" for="inputError">組長姓名&學號</label>
                    <div class="controls">
                        <input type="text" id ="leader_name" placeholder="ex : 王曉明">
                        <input type="text" id ="leader_number" placeholder="ex : A9828300">
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div id ="memberGrpoup">
                    <label class="control-label" for="inputError" >組員姓名&學號</label> 
                    <div class="control_group p_std_number">
                       <div class="controls">
                            <input type="text" placeholder="姓名" class ="name">
                            <input type="text" placeholder="學號" class ="num">
                            <span class="help-inline"></span>
                        </div>
                    </div>
                </div>
                <input type="button" value =" + " id ="plus">
                <br/>
                <hr/>
                <button type="button" class="btn" id ="submit">確認送出</button>
            </fieldset>
        </form>
    </div>
</div>
<!-------------------------------------end-------------------------------------------------->  
