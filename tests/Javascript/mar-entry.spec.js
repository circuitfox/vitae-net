import { shallowMount } from '@vue/test-utils';
import MarEntry from '../../resources/assets/js/components/MarEntry.vue';

const factory = (values = {}) => {
  return shallowMount(MarEntry, {
    propsData: {... values}
  });
}

describe('MarEntry', () => {
  beforeEach(() => {
    window.Laravel = {csrfToken: ''};
  });

  it('should display active and inactive times', () => {
    let marEntry = factory({
      meds: {0: {id: 1, name: 'test'}},
      isAdmin: true,
      route: '',
      marEntry: {
        id: 1,
        instructions: 'test',
        medId: 1,
        name: 'test',
        stat: false,
        times: [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
      },
      complete: []
    });
    expect(marEntry.contains('td.stat')).toBe(true);
    expect(marEntry.contains('td.non-stat')).toBe(true);
  });

  it("should have no active times if times array is all 0 and non-stat", () => {
    let marEntry = factory({
      meds: {0: {id: 1, name: 'test'}},
      isAdmin: true,
      route: '',
      marEntry: {
        id: 1,
        instructions: 'test',
        medId: 1,
        name: 'test',
        stat: false,
        times: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
      },
      complete: []
    });
    expect(marEntry.contains('td.stat')).toBe(false);
    expect(marEntry.contains('td.non-stat')).toBe(true);
  });

  it("should have all active times if stat", () => {
    let marEntry = factory({
      meds: {0: {id: 1, name: 'test'}},
      isAdmin: true,
      route: '',
      marEntry: {
        id: 1,
        instructions: 'test',
        medId: 1,
        name: 'test',
        stat: true,
        times: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
      },
      complete: []
    });
    expect(marEntry.contains('td.stat')).toBe(true);
    expect(marEntry.contains('td.non-stat')).toBe(false);
  });

  it('should show nurse initials for scanned times', () => {
    let marEntry = factory({
      meds: {0: {id: 1, name: 'test'}},
      isAdmin: true,
      route: '',
      marEntry: {
        id: 1,
        instructions: 'test',
        medId: 1,
        name: 'test',
        stat: false,
        times: [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
      },
      complete: [{time: '7:30 1/1/1970', student_name: 'JS', medication_id: 1}]
    });
    expect(marEntry.find('td.stat')).toBeTruthy();
    let scannedTime = marEntry.find('td.stat').element;
    console.log(scannedTime);
    expect(scannedTime.innerHTML).toContain('JS');
  });

  it('should not show nurse initials for scanned times from different meds', () => {
    let marEntry = factory({
      meds: {0: {id: 1, name: 'test'}},
      isAdmin: true,
      route: '',
      marEntry: {
        id: 1,
        instructions: 'test',
        medId: 1,
        name: 'test',
        stat: false,
        times: [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
      },
      complete: [{time: '7:30 1/1/1970', student_name: 'JS', medication_id: 2}]
    });
    expect(marEntry.find('td.stat')).toBeTruthy();
    let scannedTime = marEntry.find('td.stat').element;
    console.log(scannedTime);
    expect(scannedTime.innerHTML).not.toContain('JS');
  });
});
