import { shallowMount } from '@vue/test-utils';
import OrderList from '../../resources/assets/js/components/OrderList.vue';
import MockEcho from 'mock-echo';

const factory = (values = {}) => {
    return shallowMount(OrderList, {
      propsData: {... values}
    });
}

describe('OrderList', () => {
  let mockEcho;
  let labList;

  beforeEach(() => {
    mockEcho = new MockEcho();
    global.Echo = mockEcho;
  });

  afterEach(() => {
    delete global.Echo;
  });

  it('should show an unviewed order', () => {
    let orderList = factory({
      name: 'Joe Smith',
      route: '/orders',
      mrn: 12345,
      orders: [{id: 1, name: 'test', completed: false}],
    });

    expect(orderList.find('a.list-group-item.list-group-item-danger')).toBeTruthy();
  });

  it('should show an viewed order', () => {
    let orderList = factory({
      name: 'Joe Smith',
      route: '/orders',
      mrn: 12345,
      orders: [{id: 1, name: 'test', completed: true}],
    });

    expect(orderList.find('a.list-group-item.list-group-item-success')).toBeTruthy();
  });
});
