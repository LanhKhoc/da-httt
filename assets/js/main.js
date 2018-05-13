// NOTE: Change this to match server
const Config = {
  host: 'localhost',
  port: '9999',
  rootREL: ''
};

// NOTE: Delegate prototype
const Ajax = {
  create(Config) {
    return Object.assign(Object.create(Config), this);
  },

  serilizeObject(arr) {
    return arr.reduce((acc, cur) => {
      return {
        ...acc,
        [cur['name']]: cur['value']
      }
    }, {});
  },

  getRequest({data, url}) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: url,
        method: 'GET',
        data: data,
        success: data => resolve(data),
        error: err => reject(err)
      })
    })
  }
};

const Sidebar = function() {
  const _$sidebar = $('.js-sidebar');

  const handleClickToggle = function(e) {
    e.preventDefault();

    _$sidebar.animate({width: 'toggle'}, 200);
  }

  return {
    handleClickToggle,
  }
}

$(() => {
  const _$toggleBtn = $('.js-toggle-sidebar');

  _$toggleBtn.on('click', Sidebar().handleClickToggle);
})