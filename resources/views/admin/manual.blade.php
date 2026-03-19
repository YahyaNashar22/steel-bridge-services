@extends('admin.layout')

@section('content')
    <div class="space-y-6">
        <div class="rounded-lg bg-white p-6 shadow">
            <h1 class="text-2xl font-bold">Admin Manual</h1>
            <p class="mt-3 text-sm text-slate-600">
                This page explains what each admin area controls, how records are used on the website, and how homepage keys map to visible sections.
                Use it as the operating guide for content updates.
            </p>
        </div>

        <section class="rounded-lg bg-white p-6 shadow">
            <h2 class="text-xl font-semibold">Quick Workflow</h2>
            <div class="mt-4 space-y-3 text-sm text-slate-700">
                <p>1. Create service categories before creating services.</p>
                <p>2. Create and publish services to make them visible on the website and in service request forms.</p>
                <p>3. Use Homepage Sections for text blocks, images, videos, and keyed homepage content.</p>
                <p>4. Use Homepage Items for the circular Hard Facility and Soft Facility item cards.</p>
                <p>5. Use Homepage Tabs for the tabbed service/detail block on the homepage.</p>
                <p>6. Use Trusted By to manage the logo strip, then enable or disable its visibility from the <code>trusted_brands</code> homepage section.</p>
                <p>7. Use Settings for global company information like phone, email, address, and social URLs.</p>
                <p>8. Use Contact Messages and Service Requests to review incoming leads submitted from the website.</p>
            </div>
        </section>

        <section class="rounded-lg bg-white p-6 shadow">
            <h2 class="text-xl font-semibold">Dashboard</h2>
            <div class="mt-4 space-y-2 text-sm text-slate-700">
                <p><strong>Purpose:</strong> Snapshot of the admin system.</p>
                <p><strong>Shows:</strong> category count, service count, published service count, contact message count, service request count, trusted logo count, latest contact messages, and latest service requests.</p>
                <p><strong>Use it for:</strong> quick status checks and fast navigation to recent leads.</p>
            </div>
        </section>

        <section class="rounded-lg bg-white p-6 shadow">
            <h2 class="text-xl font-semibold">Categories</h2>
            <div class="mt-4 space-y-2 text-sm text-slate-700">
                <p><strong>Purpose:</strong> Organizes services into groups.</p>
                <p><strong>Main fields:</strong> <code>name</code>, <code>slug</code>.</p>
                <p><strong>Name:</strong> visible category label.</p>
                <p><strong>Slug:</strong> optional URL-friendly identifier. If left empty, the system may generate one.</p>
                <p><strong>Dependency:</strong> services require a category.</p>
            </div>
        </section>

        <section class="rounded-lg bg-white p-6 shadow">
            <h2 class="text-xl font-semibold">Services</h2>
            <div class="mt-4 space-y-2 text-sm text-slate-700">
                <p><strong>Purpose:</strong> Controls the main service catalogue and each service detail page.</p>
                <p><strong>Main fields:</strong> category, title, slug, short description, long description, meta title, meta description, featured image, OG image, gallery images, YouTube URLs, published flag.</p>
                <p><strong>Category:</strong> the service group shown on listings.</p>
                <p><strong>Title:</strong> shown on service cards, detail pages, and request records.</p>
                <p><strong>Slug:</strong> used in the service URL.</p>
                <p><strong>Short description:</strong> shown on listing cards and near the top of the service detail page.</p>
                <p><strong>Long description:</strong> main body content for the service detail page.</p>
                <p><strong>Meta title / meta description:</strong> SEO and browser metadata.</p>
                <p><strong>Featured image:</strong> main visual for the service and homepage preview where applicable.</p>
                <p><strong>OG image:</strong> social sharing preview image.</p>
                <p><strong>Gallery images:</strong> additional images displayed on the detail page. Existing ones can be removed individually.</p>
                <p><strong>YouTube URLs:</strong> one link per line; these appear in the Videos section on the service detail page.</p>
                <p><strong>Published:</strong> only published services appear publicly and inside the service request dropdowns.</p>
            </div>
        </section>

        <section class="rounded-lg bg-white p-6 shadow">
            <h2 class="text-xl font-semibold">Homepage Sections</h2>
            <div class="mt-4 space-y-3 text-sm text-slate-700">
                <p><strong>Purpose:</strong> Main key-value content system for the homepage. Most homepage text/image/video blocks are controlled here.</p>
                <p><strong>Main fields:</strong> <code>key</code>, <code>title</code>, <code>subtitle</code>, <code>content</code>, <code>image</code>, <code>video</code>.</p>
                <p><strong>Rule:</strong> the meaning of title/subtitle/content depends on the key. Always edit the correct key instead of creating duplicates for the same feature.</p>
            </div>

            <div class="mt-5 overflow-x-auto">
                <table class="min-w-full border border-slate-200 text-left text-sm">
                    <thead class="bg-slate-100 text-slate-700">
                        <tr>
                            <th class="px-4 py-3">Key</th>
                            <th class="px-4 py-3">Website Usage</th>
                            <th class="px-4 py-3">Field Mapping</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <tr><td class="px-4 py-3 font-medium"><code>video_hero</code></td><td class="px-4 py-3">Top video hero section.</td><td class="px-4 py-3"><code>subtitle</code> = kicker, <code>title</code> = main headline, <code>content</code> = paragraph, <code>video</code> = video file, <code>image</code> = fallback image.</td></tr>
                        <tr><td class="px-4 py-3 font-medium"><code>hero_kicker</code></td><td class="px-4 py-3">Small label above the main homepage hero title.</td><td class="px-4 py-3"><code>title</code> = label text.</td></tr>
                        <tr><td class="px-4 py-3 font-medium"><code>hero</code></td><td class="px-4 py-3">Main homepage hero block.</td><td class="px-4 py-3"><code>title</code> = hero heading, <code>content</code> = hero paragraph.</td></tr>
                        <tr><td class="px-4 py-3 font-medium"><code>hero_primary_cta</code></td><td class="px-4 py-3">Primary hero button.</td><td class="px-4 py-3"><code>title</code> = button text, <code>content</code> = URL.</td></tr>
                        <tr><td class="px-4 py-3 font-medium"><code>hero_secondary_cta</code></td><td class="px-4 py-3">Secondary hero button.</td><td class="px-4 py-3"><code>title</code> = button text, <code>content</code> = URL.</td></tr>
                        <tr><td class="px-4 py-3 font-medium"><code>hero_chip_1</code>, <code>hero_chip_2</code>, <code>hero_chip_3</code></td><td class="px-4 py-3">Small chips below the hero buttons.</td><td class="px-4 py-3"><code>title</code> = chip label.</td></tr>
                        <tr><td class="px-4 py-3 font-medium"><code>about</code></td><td class="px-4 py-3">Right-side intro card near the hero.</td><td class="px-4 py-3"><code>subtitle</code> = card kicker, <code>title</code> = card heading, <code>content</code> = description.</td></tr>
                        <tr><td class="px-4 py-3 font-medium"><code>hero_highlight_1</code>, <code>hero_highlight_2</code></td><td class="px-4 py-3">Small highlight/stat cards near the hero.</td><td class="px-4 py-3"><code>subtitle</code> = label, <code>title</code> = large value, <code>content</code> = supporting text.</td></tr>
                        <tr><td class="px-4 py-3 font-medium"><code>why_us</code>, <code>value_one</code>, <code>value_two</code></td><td class="px-4 py-3">Three homepage value cards.</td><td class="px-4 py-3"><code>subtitle</code> = kicker, <code>title</code> = heading, <code>content</code> = paragraph, <code>image</code> = optional background image.</td></tr>
                        <tr><td class="px-4 py-3 font-medium"><code>customer_centric</code></td><td class="px-4 py-3">Customer-centric feature section.</td><td class="px-4 py-3"><code>title</code> = heading, <code>subtitle</code> = accent line, <code>content</code> = paragraph, <code>image</code> = right-side image.</td></tr>
                        <tr><td class="px-4 py-3 font-medium"><code>hard_facility</code></td><td class="px-4 py-3">Hard facility text block.</td><td class="px-4 py-3"><code>title</code> = section heading, <code>content</code> = paragraph.</td></tr>
                        <tr><td class="px-4 py-3 font-medium"><code>soft_facility</code></td><td class="px-4 py-3">Soft facility text block.</td><td class="px-4 py-3"><code>title</code> = section heading, <code>content</code> = paragraph.</td></tr>
                        <tr><td class="px-4 py-3 font-medium"><code>services_preview</code></td><td class="px-4 py-3">Homepage services listing intro.</td><td class="px-4 py-3"><code>subtitle</code> = kicker, <code>title</code> = heading.</td></tr>
                        <tr><td class="px-4 py-3 font-medium"><code>trusted_brands</code></td><td class="px-4 py-3">Trusted By logo strip visibility.</td><td class="px-4 py-3"><code>title</code> = section label, <code>content</code> = <code>1</code> / <code>true</code> to show, <code>0</code> / <code>false</code> to hide.</td></tr>
                        <tr><td class="px-4 py-3 font-medium"><code>process</code></td><td class="px-4 py-3">How We Work section intro.</td><td class="px-4 py-3"><code>content</code> = small label, <code>title</code> = heading, <code>subtitle</code> = supporting text.</td></tr>
                        <tr><td class="px-4 py-3 font-medium"><code>process_step_1</code>, <code>process_step_2</code>, <code>process_step_3</code></td><td class="px-4 py-3">Three process cards.</td><td class="px-4 py-3"><code>title</code> = step label, <code>content</code> = step description.</td></tr>
                        <tr><td class="px-4 py-3 font-medium"><code>industries</code></td><td class="px-4 py-3">Industries section.</td><td class="px-4 py-3"><code>subtitle</code> = small label, <code>title</code> = heading, <code>content</code> = one industry per line.</td></tr>
                        <tr><td class="px-4 py-3 font-medium"><code>testimonials</code></td><td class="px-4 py-3">Scrolling testimonial strip.</td><td class="px-4 py-3"><code>content</code> = one testimonial per line using <code>"Quote" | Author</code>.</td></tr>
                        <tr><td class="px-4 py-3 font-medium"><code>request_cta</code></td><td class="px-4 py-3">Left-side image block in the request/contact area.</td><td class="px-4 py-3"><code>image</code> = displayed image. Current homepage version does not use this key’s text fields.</td></tr>
                        <tr><td class="px-4 py-3 font-medium"><code>walkthrough_cta</code></td><td class="px-4 py-3">Right-side Schedule A Walkthrough block.</td><td class="px-4 py-3"><code>subtitle</code> = kicker, <code>title</code> = heading, <code>content</code> = paragraph.</td></tr>
                    </tbody>
                </table>
            </div>

            <p class="mt-4 text-sm text-slate-600">
                Upload fields replace visual assets. Remove checkboxes delete the currently stored file. If a section is missing, the website may fall back to default hardcoded text.
            </p>
        </section>

        <section class="rounded-lg bg-white p-6 shadow">
            <h2 class="text-xl font-semibold">Homepage Items</h2>
            <div class="mt-4 space-y-2 text-sm text-slate-700">
                <p><strong>Purpose:</strong> Controls the circular image cards under Hard Facility and Soft Facility on the homepage.</p>
                <p><strong>Main fields:</strong> section, title, image, optional link, sort order, active flag.</p>
                <p><strong>Section:</strong> <code>hard_facility</code> or <code>soft_facility</code>. This decides where the item appears.</p>
                <p><strong>Title:</strong> shown below the circular image.</p>
                <p><strong>Image:</strong> required for each item.</p>
                <p><strong>Optional link:</strong> stored now for future or linked usage.</p>
                <p><strong>Sort order:</strong> lower numbers appear first.</p>
                <p><strong>Active:</strong> inactive items are hidden.</p>
            </div>
        </section>

        <section class="rounded-lg bg-white p-6 shadow">
            <h2 class="text-xl font-semibold">Homepage Tabs</h2>
            <div class="mt-4 space-y-2 text-sm text-slate-700">
                <p><strong>Purpose:</strong> Controls the tabbed homepage content block.</p>
                <p><strong>Main fields:</strong> title, subtitle, content, image, button text, button link, sort order, active flag.</p>
                <p><strong>Title:</strong> tab label and main panel heading.</p>
                <p><strong>Subtitle:</strong> small label above the tab content heading.</p>
                <p><strong>Content:</strong> main text for the tab panel.</p>
                <p><strong>Image:</strong> right-side panel image.</p>
                <p><strong>Button text / button link:</strong> optional CTA inside the active tab.</p>
                <p><strong>Sort order:</strong> tab order from left to right.</p>
                <p><strong>Active:</strong> inactive tabs are hidden.</p>
            </div>
        </section>

        <section class="rounded-lg bg-white p-6 shadow">
            <h2 class="text-xl font-semibold">Trusted By</h2>
            <div class="mt-4 space-y-2 text-sm text-slate-700">
                <p><strong>Purpose:</strong> Controls the customer/brand logo strip.</p>
                <p><strong>Main fields:</strong> brand name, website URL, sort order, active flag, logo image.</p>
                <p><strong>Brand name:</strong> used as the image alt text and identification label.</p>
                <p><strong>Website URL:</strong> optional link when clicking the logo.</p>
                <p><strong>Sort order:</strong> lower numbers appear earlier.</p>
                <p><strong>Active:</strong> inactive logos are hidden.</p>
                <p><strong>Important:</strong> the strip only appears when the <code>trusted_brands</code> homepage section is enabled.</p>
            </div>
        </section>

        <section class="rounded-lg bg-white p-6 shadow">
            <h2 class="text-xl font-semibold">Terms Page</h2>
            <div class="mt-4 space-y-2 text-sm text-slate-700">
                <p><strong>Purpose:</strong> Controls the Terms and Copyrights page.</p>
                <p><strong>Main fields:</strong> page title, intro text, terms content, copyright title, copyright content.</p>
                <p><strong>Usage:</strong> edit this area when legal or policy content changes. Large text areas support multi-paragraph content.</p>
            </div>
        </section>

        <section class="rounded-lg bg-white p-6 shadow">
            <h2 class="text-xl font-semibold">Settings</h2>
            <div class="mt-4 space-y-2 text-sm text-slate-700">
                <p><strong>Purpose:</strong> Global site-wide settings not tied to a single homepage block.</p>
                <p><strong>Common keys:</strong> <code>company_phone</code>, <code>company_email</code>, <code>company_address</code>, <code>facebook_url</code>, <code>instagram_url</code>, <code>linkedin_url</code>, <code>youtube_url</code>, <code>terms_page_title</code>, <code>terms_page_intro</code>, <code>terms_page_content</code>, <code>copyright_title</code>, <code>copyright_content</code>.</p>
                <p><strong>Header usage:</strong> phone and email appear in the website header contact strip when filled.</p>
                <p><strong>Footer usage:</strong> phone, email, and address appear in the footer contact section when filled.</p>
                <p><strong>Social usage:</strong> social URL keys appear in the footer as links.</p>
                <p><strong>Add New Setting:</strong> use when a new site-wide key is needed. Avoid creating duplicate keys that already exist.</p>
            </div>
        </section>

        <section class="rounded-lg bg-white p-6 shadow">
            <h2 class="text-xl font-semibold">Contact Messages</h2>
            <div class="mt-4 space-y-2 text-sm text-slate-700">
                <p><strong>Purpose:</strong> Stores website contact form submissions.</p>
                <p><strong>Use:</strong> open each message to review name, email, phone, and message body.</p>
                <p><strong>Delete:</strong> removes the record permanently from the admin list.</p>
            </div>
        </section>

        <section class="rounded-lg bg-white p-6 shadow">
            <h2 class="text-xl font-semibold">Service Requests</h2>
            <div class="mt-4 space-y-2 text-sm text-slate-700">
                <p><strong>Purpose:</strong> Stores request submissions from service forms and homepage request forms.</p>
                <p><strong>Use:</strong> open each request to review the selected service, customer details, and request description.</p>
                <p><strong>Delete:</strong> removes the request permanently from the admin list.</p>
            </div>
        </section>

        <section class="rounded-lg bg-white p-6 shadow">
            <h2 class="text-xl font-semibold">Operational Notes</h2>
            <div class="mt-4 space-y-2 text-sm text-slate-700">
                <p>Use lower <code>sort_order</code> numbers to push cards, tabs, logos, and items earlier in display order.</p>
                <p>Use the active/published checkboxes to hide content without deleting it.</p>
                <p>Deleting a record removes it from the admin database. If content may be needed later, prefer disabling it instead of deleting it.</p>
                <p>Image and video uploads replace old files. If you remove an existing file and save without a replacement, that visual area may disappear or show a fallback state on the site.</p>
                <p>For homepage section keys, keep one record per key. Creating extra records with different names will not affect the website unless the Blade files explicitly read those keys.</p>
            </div>
        </section>
    </div>
@endsection
