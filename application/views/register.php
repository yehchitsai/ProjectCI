<!-------------------------------------start-------------------------------------------------->  
<script type="text/javascript">
var projData = {projData};
console.log(projData[0]);
</script>
<div class="container">
    <div id="mainSelect" class="well span10">
        <form action ="register" method ="post" enctype="multipart/form-data">
            <input type ="hidden" name ="action" value ="finish" />
            <fieldset>
                <legend>專題註冊</legend>
                <div class="control-group p_year">
                    <label class="control-label" for="inputError">級別</label>
                    <div class="controls">
                        <select id ="project_year">
                            <option selected ="selected">請選擇</option>
                            <option>100</option>
                            <option>99</option>
                            <option>98</option>
                            <option>97</option>
                            <option>96</option>
                            <option>95</option>
                            <option>94</option>
                            <option>93</option>
                            <option>92</option>
                            <option>91</option>
                        </select>
                        <span class="help-inline"></span>
                    </div>
                </div>				
                <div class="control-group p_name">
                    <label class="control-label" for="inputError">專題名稱</label>
                    <div class="controls">
                        <input type="text" id="project_name" size="100">
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="control-group p_adviser">
                    <label class="control-label" for="inputError">指導教授</label>
                    <div class="controls">
                        <select id="sel_teacher" >
                            <option selected="selected" value="0">請選擇</option>
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
                        <textarea rows="5" cols="100"  id ="project_description"></textarea>
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="control-group p_keyword">
                    <label class="control-label" for="inputError">關鍵字</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" placeholder="ex : android,影像辨識,行動裝置" id ="project_keyword" size="100">
                        <span class="help-inline"></span>
                    </div>
                </div>
                <span class="help-block">注意! 如果關鍵字為 android 影像辨識 行動裝置三個<br/>則輸入的格式為android,影像辨識,行動裝置</span>
                <hr/>
                <div class="control-group p_leader_name">
                    <label class="control-label" for="inputError">組長姓名及學號(組員最多不可超過四位)</label>
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
							<input type="button" value =" - " class="minus">
                            <span class="help-inline"></span>
                        </div>
                    </div>
                </div>
                <input type="button" value =" + " id ="plus">
                <br/>
				<label class="control-label" for="inputError" >專題成果</label>
                <div id ="awardGrpoup">
                     
                    <div class="control_group_a p_award">
                       <div class="controls">
					   <input type="button" value =" - " class="a_minus">
                        <select class="award_type">
                            <option selected ="selected">論文</option>
							<option>競賽</option>
                        </select>					   
                            <input type="text" placeholder='黃冠雅、葉期財，"透過大專電子學習歷程進行人才推薦之行動應用"，第八屆數位教學暨資訊實務研討會(EITS 2013)，台南市，3月27日, 2013。' size="160" class="a_name">
                            <input type="file" class ="award" name="awardfile"/>
							<input type="hidden" class="award_id"/>
                            <span class="help-inline"></span>
							<span class="help-inline2"></span>
                        </div>
                    </div>
                </div>
                <input type="button" value =" + " id ="plus_a">
                <br/>			
                <hr/>
                <button type="button" class="btn" id ="submit">確認送出</button>
            </fieldset>
        </form>
    </div>
</div>
<!-------------------------------------end-------------------------------------------------->  
