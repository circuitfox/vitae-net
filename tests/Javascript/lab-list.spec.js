import { shallowMount } from '@vue/test-utils';
import LabList from '../../resources/assets/js/components/LabList.vue';
import MockEcho from 'mock-echo';

const factory = (values = {}) => {
    return shallowMount(LabList, {
      propsData: {... values}
    });
}

describe('LabList', () => {
  let mockEcho;
  let labList;

  beforeEach(() => {
    mockEcho = new MockEcho();
    global.Echo = mockEcho;
  });

  afterEach(() => {
    delete global.Echo;
  });

  it('should show an unviewed lab', () => {
    let labList = factory({
      name: 'Joe Smith',
      route: '/labs',
      mrn: 12345,
      labs: [{id: 1, name: 'test'}],
      labViews: {},
    });

    expect(labList.find('a.list-group-item.list-group-item-danger')).toBeTruthy();
  });

  it('should show an viewed lab', () => {
    let labList = factory({
      name: 'Joe Smith',
      route: '/labs',
      mrn: 12345,
      labs: [{id: 1, name: 'test'}],
      labViews: {'1': true},
    });

    expect(labList.find('a.list-group-item.list-group-item-success')).toBeTruthy();
  });
});
