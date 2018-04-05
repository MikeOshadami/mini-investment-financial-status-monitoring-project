# mini-investment-financial-status-monitoring-project

The application is a web application that is written in PHP with MySQL as database.

Project Summary:

An investment firm has 240 million naira to invest in 12 companies in Nigeria. The companies are divided into the 6 geopolitical zones in Nigeria which is South West, South East, South South, North West, North East and North Central.
The Companies are:

South West
1.	Company A
2.	Company B

South East
3.	Company C
4.	Company D

South South
5.	Company E
6.	Company F

North Central
7.	Company G
8.	Company H

North West
9.	Company I
10.	Company J

North East
11.	Company K
12.	Company L

Each of these companies was given 20 million naira each for a period of 12 months (1 year) to generate 50% profit. On a monthly basis, information of Company financial status will be generated for monitoring on how the companies are doing.

To capture data for financial status monitoring, a form will be created which will in turn feed the report (Company Financial Status Report) with data.

The form will have the following fields:

i.	Gross Income
ii.	Direct Operating Cost
iii.	Gross Profit/Loss
iv.	Administrative Expenses
v.	Marketing Expenses
vi.	EBITDA (Earnings Before Interest, Tax, Depreciation and Amortization)
vii.	Depreciation
viii.	Other Charges
ix.	PBT (Profit Before Tax)
x.	Income Tax Expenses
xi.	PAT (Profit After Tax)

The calculation behind the scene is that items ii – x will be deducted from item I and that will give us the result which is item xi. Some items are to be inputted, while some are to be calculated.
Item I – item ii will give item iii (item I and item ii will be inputted)
Item iii – item iv + item v will give item vi. (item iv and item v will be inputted and calculated against the item ii generated above).
Item vi – item vii + item viii will give item ix. (item vii and item viii will be inputted)
Item ix – item x will give item xi (item x will be inputted).
So we are capturing this data and producing report for each of the companies over a 1 month period.
