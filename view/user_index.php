
<div class="row col-md-8 col-md-offset-2 registeration">
    <!--Sign Up-->
<div class="registerInner">
        <div class="col-md-6 signUp">
            <h3 class="headerSign">Sign Up</h3>
            <form action="/user/create" method="post">


                <div class="form-group">
                    <input class="form-control" type="text" name="username" id="username" placeholder="USERNAME">
                </div>


                <div class="form-group">
                    <input class="form-control" type="email" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="YOUR EMAIL">
                </div>

                <div class="form-group ">
                    <input class="form-control" type="password" name="password" id="password" value="" placeholder="PASSWORD">
                </div>


                <button type="submit" class=" signbuttons btn btn-primary">Sign Up</button>

            </form>
        </div>

             
        <!--Sign In-->     
        <div class ="col-md-6">
            <h3 class="headerSign">Sign In</h3> 
            <form action="/user/login" method="post">
                
                <div class="form-group">                    
                    <input class="form-control" type="text" name="username" id="username" placeholder="USERNAME">
                </div>
				                
                <div class="form-group">
                    <input class="form-control" type="password" name="password" id="password" placeholder="PASSWORD" value="">
                </div>

                <button type="submit" class="signbuttons btn btn-primary">Sign In</button>

                
            </form>

            
        </div>
             
</div>
        
</div>
