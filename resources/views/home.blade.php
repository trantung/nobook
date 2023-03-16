
    <form id="user-form" action="https://basemely.com/update-profile" method="POST">
        @csrf
        <div class="form-group col-md-3 mr-auto ml-auto"></div>
        <div class="form-group col-lg-12 col-sm-12"><label for="user-name">Name &nbsp;
                <!---->
            </label> <input id="user-name" name="name" placeholder="User Name" value="kizaru" type="text" class="form-control">
        </div>
        <div class="form-group col-lg-12 col-sm-12"><label for="phone-number">Phone Number &nbsp;
                <!---->
            </label> <input id="phone-number" name="phone" value="0123456789" placeholder="Phone Number" type="text"
                class="form-control"></div>
        <div class="form-group col-lg-12 col-sm-12"><label for="email-address">Email Address&nbsp;
                <!---->
            </label> <input id="email-address" value="abc123@gmail.com" name="email" placeholder="Email Address" type="email"
                class="form-control"></div>
        <div class="form-group col-lg-12 col-sm-12"><label for="location">Location&nbsp;
                <!---->
            </label> <select required="required" name="location_id" class="form-control">
                <option value="1">
                    Hà Nội
                </option>
                <option value="2">
                    Khác
                </option>
                <option value="3">
                    Phùng Khoang, Hà Đông, Hà Nội
                </option>
            </select></div>
        <div class="form-group col-lg-12 col-sm-12"><label for="address">Address&nbsp;
                <!---->
            </label>
            <textarea id="address" name="address" placeholder="Your Address" class="form-control"></textarea>
        </div>
        <div class="form-group col-lg-12 col-sm-12">
                <input name="image" type="file"></div>
        <div class="col-lg-12 col-sm-12"><button type="submit"
                class="button button-md bg-dark2 color-white">update</button></div>
    </form>
