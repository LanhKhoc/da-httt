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

const Modal = function($parentEle, message, handleNo = (e) => e.preventDefault(), handleYes = () => {}) {
  const _$element = $(`
    <div class="o-modal">
      <div class="o-modal__wrapper">
        <div class="o-modal__backdrop"></div>
        <div class="o-modal__main">
          <p class="o-modal__message">${message}</p>
          <div class="o-modal__control">
            <button class="btn js-modal-no">Không</button>
            <button class="btn btn-primary js-modal-yes">Có</button>
          </div>
        </div>
      </div>
    </div>
  `);

  const render = function() {
    $parentEle.append(_$element);

    $parentEle.on('click', '.js-modal-no', handleNo);
    $parentEle.on('click', '.js-modal-yes', handleYes);
  }

  return {
    render
  }
}

const Customer = function() {
  const modalDel = Modal('Bạn có muốn <strong>Xóa</strong> khách hàng này?');

  const handleClickDelete = function(e) {
    modalDel.render();
  }
}

$(() => {
  const _$toggleBtn = $('.js-toggle-sidebar');
  const _$deleteBtn = $('.js-delete-action');

  _$toggleBtn.on('click', Sidebar().handleClickToggle);
})