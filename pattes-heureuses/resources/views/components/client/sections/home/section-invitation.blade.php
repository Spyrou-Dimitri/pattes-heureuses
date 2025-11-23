<x-layouts.section :bg="'paws'">
    <x-layouts.cta-section
        :title="__('client/home/cta-invitation/cta-invitation.title')"
        :paragraph="__('client/home/cta-invitation/cta-invitation.content')"
        :href_cta="route('animals.index')"
        :href_cta_title="__('client/home/cta-invitation/cta-invitation.cta-title')"
        :cta="__('client/home/cta-invitation/cta-invitation.cta')"
        :img_src_480="asset('img/480x480/cat-contact.png')"
        :img_src_600="asset('img/600x600/cat-contact.png')"
        :img_src_800="asset('img/800x800/cat-contact.png')"
        :img_alt="__('client/home/cta-invitation/cta-invitation.alt')"
    >

    </x-layouts.cta-section>
</x-layouts.section>

