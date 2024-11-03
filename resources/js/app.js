import './bootstrap';

if(role == "user")
{
    window.Echo.private('users.' + userId).notification((event)=>{
            $('#push-notify').prepend(`
                <div class="dropdown-item d-flex justify-content-between align-items-center">
                    <span id="notify-count">Post comment: ${event.post_title.substring(0, 9)}..</span>
                    <a href="${event.url}?notify=${event.id}"><i class="fa fa-eye"></i></a>
                </div>`);
                count = Number($('#notify-count').text());
                count++;
                $('#notify-count').text(count);
    });
}

// Push Contact to dashboardAdmin
if(role == "admin")
{
    window.Echo.private('admin.' + adminId).notification((event)=>{
            $('#notifyDashboard').prepend(`
                <a class="dropdown-item d-flex align-items-center" href="${event.url}?notifyAdmin=${event.id}">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">${event.date}</div>
                                <span class="font-weight-bold">${event.contact_title}</span>
                            </div>
                        </a>`);
                count = Number($('#countDashoard').text());
                count++;
                $('#countDashoard').text(count);
    });
}
