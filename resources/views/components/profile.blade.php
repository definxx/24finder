<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Profile Picture -->
            <div class="flex flex-col items-center justify-center mb-8">
                <div class="relative">
                    <img id="profile-picture" class="w-40 h-40 rounded-full object-cover border-4 border-orange-600 shadow-lg" 
                         src="{{ $user->profile_photo_path ?? 'logo.jpg' }}" alt="Profile Picture" />
                    <!-- Allow file input for updating the profile picture -->
                    <label for="profile-pic-upload" class="absolute bottom-0 right-0 bg-orange-600 p-3 rounded-full cursor-pointer shadow-md">
                        <i class="fas fa-camera text-white"></i>
                    </label>
                    <input type="file" id="profile-pic-upload" name="profile_picture" class="hidden" accept="image/*" />
                </div>
                <p class="mt-4 text-sm text-gray-500">
                    Allowed formats: JPG, PNG. Max size: 2MB.
                </p>
            </div>
        
            <div class="flex justify-end mb-6">
                <!-- Enable the upload button -->
                <button type="submit" class="bg-orange-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 shadow-md flex items-center">
                    <i class="fas fa-plus mr-2"></i>Upload picture
                </button>
            </div>
        </form>
        

        <!-- Name -->
        <div class="mb-6">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Full Name</label>
            <div class="flex items-center border-2 rounded-lg focus-within:ring-2 focus-within:ring-orange-500">
                <span class="px-3 text-gray-600"><i class="fas fa-user"></i></span>
                <input type="text" id="name" name="name" class="w-full px-3 py-2 focus:outline-none rounded-r-lg" value="{{ $user->name }}" required readonly />
            </div>
        </div>

        <!-- Email -->
        <div class="mb-6">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email Address</label>
            <div class="flex items-center border-2 rounded-lg focus-within:ring-2 focus-within:ring-orange-500">
                <span class="px-3 text-gray-600"><i class="fas fa-envelope"></i></span>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 focus:outline-none rounded-r-lg" value="{{ $user->email }}" required readonly />
            </div>
        </div>

        <!-- Phone -->
        <div class="mb-6">
            <label for="phone" class="block text-gray-700 font-semibold mb-2">Phone Number</label>
            <div class="flex items-center border-2 rounded-lg focus-within:ring-2 focus-within:ring-orange-500">
                <span class="px-3 text-gray-600"><i class="fas fa-phone"></i></span>
                <input type="tel" id="phone" name="phone" class="w-full px-3 py-2 focus:outline-none rounded-r-lg" value="{{ $user->tel }}" required readonly />
            </div>
        </div>
    </div>
</body>
