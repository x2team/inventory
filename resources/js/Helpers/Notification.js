class Notification
{
    success(){
        new Noty({
            type: 'success',
            text: 'Successfuly done!',
            layout: 'topRight',
            timeout: 1000,
            
        }).show();
    }
    alert(){
        new Noty({
            type: 'alert',
            text: 'Are u sure?',
            layout: 'topRight',
            timeout: 1000,
            
        }).show();
    }
    error(){
        new Noty({
            type: 'error',
            text: 'Something went wrong!',
            layout: 'topRight',
            timeout: 1000,
            
        }).show();
    }
    warning(){
        new Noty({
            type: 'warning',
            text: 'Opps wrong',
            layout: 'topRight',
            timeout: 1000,
            
        }).show();
    }
    image_validation(){
        new Noty({
            type: 'warning',
            text: 'Upload hình < 1MB',
            layout: 'topRight',
            timeout: 1000,
            
        }).show();
    }
}

export default Notification = new Notification();