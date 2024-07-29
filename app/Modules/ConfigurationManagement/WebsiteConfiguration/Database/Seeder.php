<?php

namespace App\Modules\ConfigurationManagement\WebsiteConfiguration\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="\App\Modules\ConfigurationManagement\WebsiteConfiguration\Database\Seeder"
     *
     */

    static $SettingTitleModel = \App\Modules\ConfigurationManagement\WebsiteConfiguration\Models\SettingTitleModel::class;
    static $SettingValueModel = \App\Modules\ConfigurationManagement\WebsiteConfiguration\Models\SettingValueModel::class;


    public function setting_save($settings)
    {
        foreach ($settings as $title) {
            $setting_title = self::$SettingTitleModel::create([
                'title' => $title['title'],
            ]);

            foreach ($title['values'] as $value) {
                self::$SettingValueModel::create([
                    'setting_title_id' => $setting_title->id,
                    'title' => $setting_title->title,
                    'value' => isset($value['value']) ? $value['value'] : null,
                    'values' => array_key_exists('values', $value) ? $value['values'] : null,
                ]);
            }
        }
    }

    public function run()
    {
        self::$SettingTitleModel::truncate();
        self::$SettingValueModel::truncate();

        $basic_settings = [
            [
                "title" => "site_name",
                "values" => [
                    [
                        "value" => "ETEK",

                    ],
                ]
            ],
            [
                "title" => "header_logo",
                "values" => [
                    [
                        "value" => "frontend/images/etek_logo.png",
                    ],
                ]
            ],

            [
                "title" => "footer_logo",
                "values" => [
                    [
                        "value" => "frontend/images/etek_logo.png",

                    ],
                ]
            ],
            [

                "title" => "fabicon",
                "values" => [
                    [
                        "value" => "frontend/images/etek_favicon.png",

                    ],
                ]
            ],
            [

                "title" => "payment_gateway_logo",
                "values" => [
                    [
                        "value" => "frontend/images/etek_favicon.png",

                    ],
                ]
            ],

            [

                "title" => "copy_right",
                "values" => [
                    [
                        "value" => "2019-24 Copy Right by ETEK.com.bd",

                    ],
                ]
            ],

            [
                "title" => "shiping_on_order",
                "values" => [
                    [
                        "value" => "free shipping on order over 5000 TK.",

                    ],
                ]
            ],

            [
                "title" => "breaking_news",
                "values" => [
                    [
                        "value" => "***প্রিয় ক্রেতামন্ডলী, প্রযুক্তি পণ্যের মূল্য অস্থিতিশীল হওয়ার কারণে যেকোন মুহূর্তে যেকোন প্রযুক্তি পণ্যের মূল্য পরিবর্তন হতে পারে। তাই অর্ডার করার পূর্বে অবশ্যই উল্লেখিত নাম্বারগুলোতে “মোবাইলঃ- ০১৭৩৩০৮০৩৭৬, ০১৭৩৩০৮০৩৫০, ফোনঃ- +৮৮০ ২-৫৫১৫৩৪৩০” যোগাযোগ করে পন্যের স্টক ও ডেলিভারি সম্পর্কে জেনে নেয়ার জন্য বিশেষভাবে অনুরোধ করা যাচ্ছে। এবং পছন্দের প্রযুক্তিপণ্য নেয়ার জন্য শপ-এ আসতে চাইলে, আজই চলে আসুন আমাদের শপ মাল্টিপ্ল্যান সেন্টারের লেভেলঃ-০৪, শপঃ-(৪০৭-৪০৯), নিউ এলিফ্যান্ট রোড, ঢাকা ১২০৫। ***
",

                    ],
                ]
            ],

        ];

        $this->setting_save($basic_settings);

        $contact_information_settings = [
            [
                "group" => "contact_information",
                "title" => "phone_numbers",
                "values" => [
                    [
                        "value" => ["+8801793-199803", "123-456-7898"]
                    ],
                    [
                        "value" => "123-456-7898",
                    ],
                    [
                        "values" => ["+8801793-199803", "123-456-7898"]
                    ],
                ],

            ],
            [
                "group" => "contact_information",
                "title" => "whatsapp",
                "values" => [
                    [
                        "value" => "",
                    ],
                ]
            ],
            [
                "group" => "contact_information",
                "title" => "telegram",
                "values" => [
                    [
                        "value" => "",
                    ],
                ]
            ],
            [
                "group" => "contact_information",
                "title" => "emails",
                "values" => [
                    [
                        "value" => "support@etek.com.bd",
                    ],
                ]
            ],
            [
                "group" => "contact_information",
                "title" => "map_link",
                "values" => [
                    [
                        "value" => '<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d6423.24786250228!2d25.459764!3d36.394097!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1722161641522!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                    ],
                ]
            ],

            [
                "group" => "contact_information",
                "title" => "address",
                "values" => [
                    [
                        "value" => "ETEK BD, Bangladesh-3654123",
                    ],
                ]
            ],
        ];

        $this->setting_save($contact_information_settings);

        $social_media_settings = [
            [
                "group" => "social_media",
                "title" => "facebook",
                "values" => [
                    [
                        "value" => "https://www.facebook.com/etekbd/",

                    ],
                ]
            ],
            [
                "group" => "social_media",
                "title" => "youtube",
                "values" => [
                    [
                        "value" => "https://www.youtube.com/@etekbd",

                    ],
                ]
            ],


        ];

        $this->setting_save($social_media_settings);

        $seo_settings = [
            [
                "group" => "seo",
                "title" => "title",
                "values" => [
                    [
                        "value" => "ETEK Enterprise: Your One-Stop Shop for Electronics, Gadgets, and Medicines",

                    ],
                ]
            ],
            [
                "group" => "seo",
                "title" => "description",
                "values" => [
                    [
                        "value" => "Discover the best in electronics, cutting-edge gadgets, and essential medicines at ETEK Enterprise. Our wide range of high-quality products ensures you find exactly what you need, whether it's the latest tech innovations or reliable health solutions. Shop with confidence, enjoy great deals, and experience exceptional customer service. Stay connected with ETEK Enterprise - where technology meets healthcare.",

                    ],
                ]
            ],
            [
                "group" => "seo",
                "title" => "image",
                "values" => [
                    [
                        "value" => "frontend/images/etek_logo.png",
                    ],
                ]
            ],
            [
                "group" => "seo",
                "title" => "keywords",
                "values" => [
                    [
                        "value" => "ETEK",

                    ],
                ]
            ],
            [
                "group" => "seo",
                "title" => "tag",
                "values" => [
                    [
                        "value" => "ETEK",

                    ],
                ]
            ],
            [
                "group" => "seo",
                "title" => "schema_tag",
                "values" => [
                    [
                        "value" => "ETEK",

                    ],
                ]
            ],
        ];

        $this->setting_save($seo_settings);

        $term_pages = [
            [
                "group" => "term_pages",
                "title" => "institute_short_intro",
                "values" => [
                    [
                        "value" => $this->short_intro(),
                    ],
                ]
            ],
            [
                "group" => "term_pages",
                "title" => "institute_long_intro",
                "values" => [
                    [
                        "value" => $this->long_intro(),
                    ],
                ]
            ],
            [
                "group" => "term_pages",
                "title" => "terms_and_condition",
                "values" => [
                    [
                        "value" => "terms_and_condition",
                    ],
                ]
            ],
            [
                "group" => "term_pages",
                "title" => "refund_policy",
                "values" => [
                    [

                        "value" => "refund_policy",
                    ],
                ]
            ],
            [
                "group" => "term_pages",
                "title" => "coockies_policy",
                "values" => [
                    [

                        "value" => "coockies_policy",

                    ],
                ]
            ],
            [
                "group" => "term_pages",
                "title" => "sitemap",
                "values" => [
                    [
                        "value" => $this->site_map(),
                    ],
                ]
            ],
        ];

        $this->setting_save($term_pages);
    }

    public function site_map()
    {
        return <<<HTML
        <div class="footer-main">
            <div class="footer-box">
                <div class="footer-title mobile-title"><h5>about</h5></div>
                <div class="footer-contant">
                    <div class="footer-logo">
                        <a href="/"><img src="/cache/frontend/images/etek_logo.png" class="img-fluid" alt="logo"></a>
                    </div>
                    <div>
                        <h2 class="mb-3" style="font-size:20px;">ETEK Enterprise: Your One-Stop Shop for Electronics, Gadgets, and Medicines</h2>
                        <p style="text-align:justify;">
                            Discover the best in electronics, cutting-edge gadgets, and essential medicines at ETEK Enterprise. Our wide range of high-quality products ensures you find exactly what you need, whether it's the latest tech innovations or reliable health solutions. Shop with confidence, enjoy great deals, and experience exceptional customer service. Stay connected with ETEK Enterprise - where technology meets healthcare.
                        </p>
                    </div>
                    <ul class="sosiyal">
                        <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-rss"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-box">
                <div class="footer-title"><h5>my account</h5></div>
                <div class="footer-contant">
                    <ul>
                        <li><a href="/about">about us</a></li>
                        <li><a href="/contact">contact us</a></li>
                        <li><a href="/terms_conditions">terms &amp; conditions</a></li>
                        <li><a href="/returns_exchanges">returns &amp; exchanges</a></li>
                        <li><a href="/shipping_delivery">shipping &amp; delivery</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-box">
                <div class="footer-title"><h5>contact us</h5></div>
                <div class="footer-contant">
                    <ul class="contact-list">
                        <li><i class="fa fa-map-marker"></i>ETEK BD <br> bangladesh-<span>3654123</span></li>
                        <li><i class="fa fa-phone"></i>call us: <span>123-456-7898</span></li>
                        <li><i class="fa fa-envelope-o"></i>email us: support@etek.com.bd</li>
                        <li><i class="fa fa-fax"></i>fax <span>123456</span></li>
                    </ul>
                </div>
            </div>
            <div class="footer-box">
                <div class="footer-title"><h5>newsletter</h5></div>
                <div class="footer-contant">
                    <div class="newsletter-second">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="enter full name">
                                <span class="input-group-text"><i class="ti-user"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="enter email address">
                                <span class="input-group-text"><i class="ti-email"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="javascript:void(0)" class="btn btn-solid btn-sm">submit now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        HTML;
    }

    public function short_intro()
    {
        return "ETEK Enterprise: Your One-Stop Shop for Electronics, Gadgets, and Medicines";
    }
    public function long_intro()
    {
        return "Discover the best in electronics, cutting-edge gadgets, and essential medicines at ETEK Enterprise. Our wide range of high-quality products ensures you find exactly what you need, whether it's the latest tech innovations or reliable health solutions. Shop with confidence, enjoy great deals, and experience exceptional customer service. Stay connected with ETEK Enterprise - where technology meets healthcare.";
    }
}
