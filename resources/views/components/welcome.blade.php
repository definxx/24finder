<div class="container my-4 ">
    <div class="row">
        <!-- Left Column (List of Users) -->
        <div class="col-md-4  d-none d-md-block">
            @auth
            <!-- User List Items -->
            <div class="post-item d-flex justify-content-between align-items-center mb-2">
                <div class="d-flex align-items-center">
                    <img src="https://via.placeholder.com/50" width="50" height="50" class="rounded-circle me-2" alt="User Profile Picture" />
                    <div>
                        <h6 class="mb-0">User 1</h6>
                        <small class="text-muted">Joined: Dec 21, 2024</small>
                    </div>
                </div>
                <button class="btn btn-primary btn-sm">Follow</button>
            </div>
            <!-- More users -->
            @endauth
        </div>

        <!-- Center Column (User Post Creation) -->
        <div class="col-md-4  ">
            @auth
            <div class="post-box">
                <h5 class="text-center mb-3">Create a Post</h5>
                <form>
                    <div class="mb-3">
                        <textarea class="form-control" placeholder="What's on your mind?" rows="4"></textarea>
                    </div>
                    <div class="mb-3 text-center">
                        <label for="fileInput" class="file-upload-icon">
                            <i class="fa fa-camera fa-2x text-muted" style="cursor: pointer;"></i>
                        </label>
                        <input type="file" class="form-control d-none" id="fileInput" />
                    </div>
                    <button type="submit" class="btn btn-post w-100" style="background-color: #483e94; color: white;">Post</button>
                </form>
            </div>
            @endauth

            <br>
         <!-- Recent Posts under "Create a Post" -->
        
         <div class="post-item">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="d-flex align-items-center">
                    <img src="https://via.placeholder.com/50" class="profile-img rounded-circle me-2" alt="User Profile Picture" />
                    <div>
                        <h6 class="mb-0">User 2</h6>
                        <small class="text-muted">Posted on: Dec 22, 2024, 9:00 AM</small>
                    </div>
                </div>
            </div>
            <p>This is a dummy post from User 2. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <img src="https://via.placeholder.com/300x150" class="img-fluid w-100 rounded mb-3" alt="Post Image" />
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <button class="btn btn-link text-muted p-0 me-3"><i class="fa fa-thumbs-up"></i> Like (<span>15</span>)</button>
                    <button class="btn btn-link text-muted p-0 me-3"><i class="fa fa-thumbs-down"></i> Dislike (<span>1</span>)</button>
                    <button class="btn btn-link text-muted p-0 me-3 comment-btn"><i class="fa fa-comment"></i> Comment</button>
                    <button class="btn btn-link text-muted p-0 me-3"><i class="fa fa-share"></i> Share</button>
                </div>
            </div>
            <div class="comment-input mt-3 d-none">
                <textarea class="form-control mb-2" placeholder="Write a comment..."></textarea>
                <button class="btn btn-primary btn-sm">Submit</button>
            </div>
        </div>
        
            
        </div>






        <!-- Right Column (Groups) -->
        <div class="col-md-4   d-none d-md-block">
            @auth
            <h5>Groups</h5>
            <div class="post-item">
                <div>
                    <h6>Group 1</h6>
                    <p>Description of Group 1.</p>
                </div>
            </div>
            <div class="post-item">
                <div>
                    <h6>Group 2</h6>
                    <p>Description of Group 2.</p>
                </div>
            </div>
            @endauth
        </div>
    </div>
</div>
