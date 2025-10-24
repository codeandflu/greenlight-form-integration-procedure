# greenlight-form-integration-procedure
Detailed walkthrough to set up greenlight forms on wordpress


# Features
-A Custom Post Type (form_submission) for storing messages
-Email notifications for admin & users
-Google Sheets integration for record backup
-A front-end shortcode to display submissions
-Admin panel customization to make submissions read-only and cleanly viewable

# Implementation Steps
I have created a basic form with this structure. I have used the green light blocks in this exact structure

1. Create Form Element
  → Input (type=text, name=name, placeholder="Your Name")
  → Input (type=email, name=email, placeholder="Your Email")
  → Textarea (name=message, placeholder="Your Message")
  → Input (type=hidden, name=action, value=handle_contact_form)
  → Input (type=submit, value="Send Message")

  In the form element set method as "POST". And Action URL as "https://yourwebsite.com/wp-admin/admin-post.php". Its integral that you enter the complete Absolute URL. Missing the https:// or http:// will throw errors.

2. Next create a thank you page. Keep the slug as thank-you.
    We'll use the page as the page the user will be redirected after filling out the form.

3. Now create a google sheet. with these names in the header.
    
    Date |	Name |	Email |	Message

    Keep the sheet name as Sheet1 as the code references this.
    After that go to extensions  →  appscript → paste the code from this <a href="appscript.js">appscript.js</a> and click save
    After that click deploy → New Deployment. On the popup that appears click the gear icon to choose web app. Set execute as "Me" and who has access to anyone. Click deploy.
    You will get a deployment url copy it as store it somewhere.

4. Create a child theme or use code snippets plugin to paste the php code provided as per your requirement.

5. Use this code to register a custom post type this will appear as Form Submissions. 
<a href="greenlight-form-integration-procedure/cpt.php">cpt.php</a>

6. I have added some customizations to this you may tweak it as per your requirement or omit entirely if not required.
<a href="greenlight-form-integration-procedure/custom-cpt.php">custom-cpt.php</a>

7. The form-handler.php preps the data for behaviours such as 
    
    - emailing to recipients, admin.
    - Storing on google sheet make sure you replace my deployment id (fake) with yours
        $google_script_url = 'https://script.google.com/macros/s/AKfycbyD9xni2qDIP5YFrMA1OMc78nDi2LT-3dObLw_DhFU3LIqzEqZEVBFtPbmv6PU24A/exec';

    - Also if your thank you page has a different slug than mine(thank-you), then replace it here:
        wp_redirect(home_url('/thank-you'));

    - Replace my mail (codeandflu@gmail.com) with the admin email you require

    <a href="greenlight-form-integration-procedure/form-handler.php">form-handler.php</a>

        
8. The display-submissions-shortcode.php lets you display the details filled by form reciients as table you can use the short code "form-submissions" to get them listed on a page. I understand this is something and stupid and not required for contact form. I did it out of curiosity


<a href="greenlight-form-integration-procedure/form-handler.php">display-submissions-shortcode.php</a>




