# Avibi Blog — Flatsome Child Theme

Child theme cho **Flatsome 3.20.8**. Dùng nó, blog WordPress sẽ có giao diện giống hệt [avibi.ai/blogs](https://avibi.ai/blogs).

Theme đổi giao diện của các trang blog: trang chủ blog, trang danh mục, thẻ, tác giả, lưu trữ theo ngày và trang bài viết. Mọi trang khác vẫn dùng Flatsome như bình thường.

> Repo này **không** chứa theme Flatsome gốc. Flatsome là theme trả phí, cần mua bản quyền từ UX Themes và cài riêng.

## Cài đặt

1. Cài và kích hoạt theme cha **Flatsome**.
2. Nén thư mục `flatsome-child/` thành file zip. File zip phải có thư mục `flatsome-child` ở cấp ngoài cùng.
3. Vào **Giao diện → Thêm mới → Tải lên**, chọn file zip đó rồi kích hoạt.
4. **Cài đặt → Đọc**: chọn trang có slug `blogs` làm "Trang bài viết".
5. **Cài đặt → Đường dẫn tĩnh**:
   - Cấu trúc tùy chỉnh: `/blogs/%postname%/`
   - Tiền tố danh mục: `blogs/category`
6. Tạo trang con của `blogs` với slug `all`, chọn mẫu **"Avibi — Tất cả bài viết"**.
7. Tạo các danh mục `insights`, `tutorials`, `announcements`, `others`.
8. Đánh dấu **Sticky** cho những bài muốn ghim ở cột bên phải.

## Tùy chỉnh

**Giao diện → Tùy biến → Avibi Blog** có các mục sau:

| Mục | Nội dung |
|---|---|
| Header | Header cố định khi cuộn, logo, nhãn Beta, menu, nút ngôn ngữ, nút đơn vị tiền, nút đăng nhập |
| Footer | Logo, thông tin công ty, 2 cột menu, điện thoại và email, dòng bản quyền |
| Trang chủ blog | Thanh danh mục, bài nổi bật, danh sách bài, bài ghim, khối thông báo sản phẩm, link RSS |
| Bài viết | Đường dẫn (breadcrumb), mục lục, tác giả, ngày, số bình luận, ảnh bìa, bài liên quan |
| Danh mục & Tất cả bài viết | Ảnh, mô tả ngắn, số bài mỗi lần tải, chữ nút "Tải thêm" |

**Thông tin công ty** nhập mỗi dòng một mục theo dạng `Nhãn: Nội dung`. Muốn nội dung thành link thì thêm ` | https://...` vào cuối dòng.

**Menu** sửa ở **Giao diện → Menu**. Có 4 vị trí:

- `Avibi Blog — Menu header`
- `Avibi Blog — Footer: Sản phẩm`
- `Avibi Blog — Footer: Về Avibi Gateway`
- `Avibi Blog — Thanh danh mục`

Vị trí nào chưa gán menu thì hiện menu mặc định giống avibi.ai.

## Cấu trúc

```
flatsome-child/
├── functions.php              # Nạp inc/avibi-blog.php
├── inc/avibi-blog.php         # Cài đặt Tùy biến, các hàm hỗ trợ, nạp CSS/JS
├── header-avibi.php           # Header của các trang blog
├── footer-avibi.php           # Footer của các trang blog
├── home.php                   # Trang chủ blog (/blogs)
├── archive.php                # Trang danh mục, thẻ, tác giả, theo ngày
├── single.php                 # Trang bài viết
├── page-templates/blog-all-posts.php   # Mẫu trang "Tất cả bài viết"
├── template-parts/avibi/      # Thẻ bài viết, danh sách lưu trữ, mục lục
└── assets/                    # CSS, JS, font Inter và Geist Mono, logo, icon
```

## Lưu ý

- Trên các trang blog, CSS của Flatsome bị tắt để giao diện không bị lẫn. Các trang khác không bị ảnh hưởng.
- Nút ngôn ngữ và nút VND/USD chỉ thay đổi hiển thị trên giao diện. Muốn dịch bài viết thật, cần cài plugin đa ngôn ngữ như Polylang hoặc WPML.
- Font Inter và Geist Mono dùng giấy phép SIL Open Font License.
