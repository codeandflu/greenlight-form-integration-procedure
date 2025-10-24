# greenlight-form-integration-procedure
Detailed walkthrough to set up greenlight forms on wordpress. It took me some time to get this right so any help is supported. You can buy me a coffee here. 

<h1><a href="https://buymeacoffee.com/codeandflu" style="color: yellow; text-decoration: none;">BUY ME A COFFEE</a></h1>


# Features
-A Custom Post Type (form_submission) for storing messages<br>
-Email notifications for admin & users<br>
-Google Sheets integration for record backup<br>
-A front-end shortcode to display submissions<br>
-Admin panel customization to make submissions read-only and cleanly viewable<br>

# Implementation Steps
I have created a basic form with this structure. I have used the green light blocks in this exact structure

1. Create Form Element with these elements inside with exact same options<br>
  → Input (type=text, name=name, placeholder="Your Name")<br>
  → Input (type=email, name=email, placeholder="Your Email")<br>
  → Textarea (name=message, placeholder="Your Message")<br>
  → Input (type=hidden, name=action, value=handle_contact_form)<br>
  → Input (type=submit, value="Send Message")<br>
  
    In the form element set method as "POST". And Action URL as "https://yourwebsite.com/wp-admin/admin-post.php"<br>
    <em>Its integral that you enter the complete Absolute URL. Missing the https:// or http:// will throw errors.</em>



2. Next create a thank you page from admin dashboard. Keep the slug as thank-you.
    We'll use the page as the page the user will be redirected after filling out the form.


3. Now create a google sheet. with these names in the header. (A1-D1)
    <table border="1">
    <tr>
    <th>A1</th>
    <th>B1</th>	
    <th>C1</th> 
    <th>D1</th>
    </tr>
    
    <tr>
    <td>Date</td>
    <td>Name</td>	
    <td>Email</td> 
    <td>Message</td>
    </tr></table>

    Keep the sheet name as Sheet1 as the code references this.<br>
    After that go to extensions  →  appscript → paste the code from this <a href="./app-script.js">app-script.js</a> and click save<br>
    After that click deploy → New Deployment. On the popup that appears click the gear icon to choose web app. Set execute as "Me" and who has access to anyone. Click deploy.<br>
    You will get a deployment url copy it and store it somewhere.

4. Use a child theme or use code snippets plugin to paste the php codes provided in the next steps as per your requirement.

5. Use this code to register a custom post type this will appear as Form Submissions. This helps to display data in admin dashboard. <a href="./create-cpt.php">create-cpt.php</a>

6. I have added some customizations to this to tweak the appearance of it as a table you may tweak it as per your requirement or omit entirely if not required. <a href="./custom-cpt.php">custom-cpt.php</a>

7. The form-handler.php preps the data for behaviours such as 
    
    - emailing to recipients, and admin.
    - Storing on google sheet. make sure you replace my deployment id (fake) with yours
        $google_script_url = 'https://script.google.com/macros/s/AKfycbyD9xni2qDIP5YFrMA1OMc78nDi2LT-3dObLw_DhFU3LIqzEqZEVBFtPbmv6PU24A/exec';

    - Also if your thank you page has a different slug than mine(thank-you), then replace it here:
        wp_redirect(home_url('/thank-you'));

    - Replace my mail (codeandflu@gmail.com) with the admin email you require for admin mail

    <a href="./form-handler.php">form-handler.php</a>

        
8. The display-submissions-shortcode.php lets you display the details filled by form recipients as table you can use the short code "form-submissions" to get them shown on a page. I understand this is something  stupid and not required for contact form. I did it out of curiosity.You can skip this if not required <a href="./form-handler.php">display-submissions-shortcode.php</a>



<h1><a href="https://buymeacoffee.com/codeandflu" style="color: yellow; text-decoration: none;">BUY ME A COFFEE</a></h1>



