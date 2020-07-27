<p align="center"><img src="https://kiaisoft.com/images/logo_ft.svg" width="100"></p>

## Project Coding Convention

- Quy tắc đặt tên:
	- Controller: 
		- Đặt tên controller tường minh dễ hiểu, không quá dài (max 3 từ)
		- Ví dụ với chức năng graph setting thì đặt tên là GraphSettingController thay vì SettingController(chung chung, không biết Setting cho cái gì)
		- Không dùng Model trực tiếp trong Controller mà gọi từ Repository
		- Hạn chế dùng raw query mà sử dụng Eloquent, trừ trường hợp Query quá phức tạp(ví dụ join nhiều bảng, lấy dữ liệu xử lí phức tạp...)
	- Request: 
		- Đặt tên Request không quá dài (max 3 từ), kết thúc bằng Request 
		- Ví dụ (CreateUserRequest)
		- Sử dụng rules và attributes (rules để quy định cách validate, attributes quy định tên của đối tượng validate)
		- Sử dụng custom validation nếu rules và attributes ko handle hết được
		- Sử dụng Rule của laravel nếu cần validate phức tạp. Document https://laravel.com/docs/6.x/validation#using-rule-objects
		- Nếu có những message đặc biệt mà trong request ko xử lý được bằng attritube thì nên viết vào đoạn Custom Validation Language Lines của file validation.jp
	- Về Route: 
		- Với các chức năng CRUD, tận dụng hết các route theo restful, tên dễ hiểu, tường minh, có namespace
		- Viết theo chuẩn kebab-case (cách từ bằng dấu -) 
		- Ví dụ: 
			- Không nên viết: createGraphSetting, list_graph_setting ......
			- Nên viết: graph-settings.index, graph-settings.create (tên resource - tên action)
	
	- Về cách đặt tên biến:
		- Có thể sử dụng camelCase($colorCodes) hoặc snake_case ($color_codes), tuy nhiên nên dùng camelCase
	
	- Về view
		- Đặt tên theo chuẩn kebab-case
		- Ví dụ: Không nên đặt tên là settingAccount.blade.php => nên viết là setting-account.blade.php
		- Các màn hình con trong một chức năng đặt trong cùng 1 folder (tên folder cũng viết theo kebab-case)
	
- Quy tắc coding
	- Luôn phải check isset khi gọi thuộc tính của 1 object có thể là null
		- Đặc biệt khi lấy thuộc tính của 1 relationship (ví dụ user->profile->user_name)
		- Trong trường hợp này phải check user->profile có null không trước khi gọi đến property user_name 
		=> phải check isset của thằng cha trước, hoặc dùng php 7 null coalescing operator (google)
		- isset(user->profile)
		- optional(user->profile)->user_name
		- user->profile->user_name ?? ''
		
	- Không hard-coding , với các magic number thì phải define ở file constant
	- Với các function sử dụng nhiều thì viết vào Helper
	
- Dùng laravel-datatables thay vì jquery datatables

- Quy tắc khi code front end
	- Button: Để tất cả sang bên phải
		- Save, search, preview, add new, send message: màu xanh lá
		- Cancel: màu gray
		- Delete: màu đỏ
	- Các field required: phải có dấu * đỏ ở label. Validate dòng chữ màu đỏ để ở dưới ô input sử dụng thẻ span và class span. Tham khảo ở template adminlte
	- Trong form label và input đều căn trái
	- Code ở file blade phải tách riêng các phân css, content, js. Css => section('style'), JS => section('script'), content => section('content')
	- Form thì sử dụng js để validate https://jqueryvalidation.org/


**Lưu ý: Mọi người nên tham khảo template trước khi code**
