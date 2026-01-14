#!/bin/bash
if [ -f GOOGLE_CREDENTIALS_SETUP.md ]; then
  sed -i 's/572464999240-gb0h7ocs8m8vncm6gvmg805bd35o8egc\.apps\.googleusercontent\.com/YOUR_CLIENT_ID_HERE/g' GOOGLE_CREDENTIALS_SETUP.md
  sed -i 's/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/YOUR_CLIENT_SECRET_HERE/g' GOOGLE_CREDENTIALS_SETUP.md
fi
if [ -f app/Console/Commands/UpdateGoogleCredentials.php ]; then
  sed -i 's/572464999240-gb0h7ocs8m8vncm6gvmg805bd35o8egc\.apps\.googleusercontent\.com/YOUR_CLIENT_ID_HERE/g' app/Console/Commands/UpdateGoogleCredentials.php
  sed -i 's/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/YOUR_CLIENT_SECRET_HERE/g' app/Console/Commands/UpdateGoogleCredentials.php
fi
if [ -f update_google_credentials.php ]; then
  sed -i 's/572464999240-gb0h7ocs8m8vncm6gvmg805bd35o8egc\.apps\.googleusercontent\.com/YOUR_CLIENT_ID_HERE/g' update_google_credentials.php
  sed -i 's/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/YOUR_CLIENT_SECRET_HERE/g' update_google_credentials.php
fi
