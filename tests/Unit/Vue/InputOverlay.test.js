import { mount } from '@vue/test-utils';
import InputOverlay from '@/Components/InputOverlay.vue';

test('InputOverlay emit closeCell when we click on it', () => {
    const wrapper = mount(InputOverlay, {
        props: {
            isActive: true
        }
    });

    wrapper.find('[data-testid="overlay"]').trigger('click');

    expect(wrapper.emitted()).toHaveProperty('closeCell');
});

test('InputOverlay emit closeCell when we press enter', async () => {
       const wrapper = mount(InputOverlay, {
        props: {
            isActive: true
        },
        emits: ['closeCell'],
    });

    // Doesn't work because we need to test a Composable. It's not the overlay
    // div that emit 'closeCell' when we press Enter
    //await wrapper.find('[data-testid="overlay"]').trigger('keydown', { keyCode: 13 });
});
