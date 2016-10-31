<?php

// php_stats PECL

/**
 * Returns the absolute deviation of an array of values
 * @link http://php.net/manual/en/function.stats-absolute-deviation.php
 * @param array $a <p>
 * array of values
 * </p>
 * @return float 
 */
function stats_absolute_deviation ($a) { }

/**
 * Method Cumulative distribution function (P) is calculated directly by code associated with the 
 * following reference. DiDinato, A. R. and Morris, A. H. Algorithm 708: Significant Digit Computation 
 * of the Incomplete Beta Function Ratios. ACM Trans. Math. Softw. 18 (1993), 360-373. Computation of 
 * other parameters involve a search for a value that produces the desired value of P. The search 
 * relies on the monotonicity of P with the other parameter. Note The beta density is proportional to 
 * t^(A-1) * (1-t)^(B-1) Arguments P -- The integral from 0 to X of the chi-square distribution. Input 
 * range: [0, 1]. Q -- 1-P. Input range: [0, 1]. P + Q = 1.0. X -- Upper limit of integration of beta 
 * density. Input range: [0,1]. Search range: [0,1] Y -- 1-X. Input range: [0,1]. Search range: [0,1] X 
 * + Y = 1.0. A -- The first parameter of the beta density. Input range: (0, +infinity). Search range: 
 * [1D-100,1D100] B -- The second parameter of the beta density. Input range: (0, +infinity). Search 
 * range: [1D-100,1D100] STATUS -- 0 if calculation completed correctly -I if input parameter number I 
 * is out of range 1 if answer appears to be lower than lowest search bound 2 if answer appears to be 
 * higher than greatest search bound 3 if P + Q .ne. 1 4 if X + Y .ne. 1 BOUND -- Undefined if STATUS 
 * is 0 Bound exceeded by parameter number I if STATUS is negative. Lower search bound if STATUS is 1. 
 * Upper search bound if STATUS is 2.
 * @link http://php.net/manual/en/function.stats-cdf-beta.php
 * @param float $par1 <p>
 * 
 * </p>
 * @param float $par2 <p>
 * 
 * </p>
 * @param float $par3 <p>
 * 
 * </p>
 * @param int $which <p>
 * Integer indicating which of the next four argument values is to be calculated from the others. Legal 
 * range: 1..4 which = 1 : Calculate P and Q from X,Y,A and B which = 2 : Calculate X and Y from P,Q,A 
 * and B which = 3 : Calculate A from P,Q,X,Y and B which = 4 : Calculate B from P,Q,X,Y and A
 * </p>
 * @return float STATUS -- 0 if calculation completed correctly -I if input parameter number I is out of range 1 if 
 * answer appears to be lower than lowest search bound 2 if answer appears to be higher than greatest 
 * search bound 3 if P + Q .ne. 1 4 if X + Y .ne. 1
 */
function stats_cdf_beta ($par1, $par2, $par3, $which) { }

/**
 * Calculates any one parameter of the binomial distribution given values for the others.
 * @link http://php.net/manual/en/function.stats-cdf-binomial.php
 * @param float $par1 <p>
 * 
 * </p>
 * @param float $par2 <p>
 * 
 * </p>
 * @param float $par3 <p>
 * 
 * </p>
 * @param int $which <p>
 * 
 * </p>
 * @return float 
 */
function stats_cdf_binomial ($par1, $par2, $par3, $which) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-cdf-cauchy.php
 * @param float $par1 <p>
 * 
 * </p>
 * @param float $par2 <p>
 * 
 * </p>
 * @param float $par3 <p>
 * 
 * </p>
 * @param int $which <p>
 * 
 * </p>
 * @return float 
 */
function stats_cdf_cauchy ($par1, $par2, $par3, $which) { }

/**
 * Calculates any one parameter of the chi-square distribution given values for the others.
 * @link http://php.net/manual/en/function.stats-cdf-chisquare.php
 * @param float $par1 <p>
 * 
 * </p>
 * @param float $par2 <p>
 * 
 * </p>
 * @param int $which <p>
 * 
 * </p>
 * @return float 
 */
function stats_cdf_chisquare ($par1, $par2, $which) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-cdf-exponential.php
 * @param float $par1 <p>
 * 
 * </p>
 * @param float $par2 <p>
 * 
 * </p>
 * @param int $which <p>
 * 
 * </p>
 * @return float 
 */
function stats_cdf_exponential ($par1, $par2, $which) { }

/**
 * Calculates any one parameter of the F distribution given values for the others.
 * @link http://php.net/manual/en/function.stats-cdf-f.php
 * @param float $par1 <p>
 * 
 * </p>
 * @param float $par2 <p>
 * 
 * </p>
 * @param float $par3 <p>
 * 
 * </p>
 * @param int $which <p>
 * 
 * </p>
 * @return float 
 */
function stats_cdf_f ($par1, $par2, $par3, $which) { }

/**
 * Calculates any one parameter of the gamma distribution given values for the others.
 * @link http://php.net/manual/en/function.stats-cdf-gamma.php
 * @param float $par1 <p>
 * 
 * </p>
 * @param float $par2 <p>
 * 
 * </p>
 * @param float $par3 <p>
 * 
 * </p>
 * @param int $which <p>
 * 
 * </p>
 * @return float 
 */
function stats_cdf_gamma ($par1, $par2, $par3, $which) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-cdf-laplace.php
 * @param float $par1 <p>
 * 
 * </p>
 * @param float $par2 <p>
 * 
 * </p>
 * @param float $par3 <p>
 * 
 * </p>
 * @param int $which <p>
 * 
 * </p>
 * @return float 
 */
function stats_cdf_laplace ($par1, $par2, $par3, $which) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-cdf-logistic.php
 * @param float $par1 <p>
 * 
 * </p>
 * @param float $par2 <p>
 * 
 * </p>
 * @param float $par3 <p>
 * 
 * </p>
 * @param int $which <p>
 * 
 * </p>
 * @return float 
 */
function stats_cdf_logistic ($par1, $par2, $par3, $which) { }

/**
 * Calculates any one parameter of the negative binomial distribution given values for the others.
 * @link http://php.net/manual/en/function.stats-cdf-negative-binomial.php
 * @param float $par1 <p>
 * 
 * </p>
 * @param float $par2 <p>
 * 
 * </p>
 * @param float $par3 <p>
 * 
 * </p>
 * @param int $which <p>
 * 
 * </p>
 * @return float 
 */
function stats_cdf_negative_binomial ($par1, $par2, $par3, $which) { }

/**
 * Calculates any one parameter of the non-central chi-square distribution given values for the others.
 * @link http://php.net/manual/en/function.stats-cdf-noncentral-chisquare.php
 * @param float $par1 <p>
 * 
 * </p>
 * @param float $par2 <p>
 * 
 * </p>
 * @param float $par3 <p>
 * 
 * </p>
 * @param int $which <p>
 * 
 * </p>
 * @return float 
 */
function stats_cdf_noncentral_chisquare ($par1, $par2, $par3, $which) { }

/**
 * Calculates any one parameter of the Non-central F distribution given values for the others.
 * @link http://php.net/manual/en/function.stats-cdf-noncentral-f.php
 * @param float $par1 <p>
 * 
 * </p>
 * @param float $par2 <p>
 * 
 * </p>
 * @param float $par3 <p>
 * 
 * </p>
 * @param float $par4 <p>
 * 
 * </p>
 * @param int $which <p>
 * 
 * </p>
 * @return float 
 */
function stats_cdf_noncentral_f ($par1, $par2, $par3, $par4, $which) { }

/**
 * Calculates any one parameter of the Poisson distribution given values for the others.
 * @link http://php.net/manual/en/function.stats-cdf-poisson.php
 * @param float $par1 <p>
 * 
 * </p>
 * @param float $par2 <p>
 * 
 * </p>
 * @param int $which <p>
 * 
 * </p>
 * @return float 
 */
function stats_cdf_poisson ($par1, $par2, $which) { }

/**
 * Calculates any one parameter of the T distribution given values for the others.
 * @link http://php.net/manual/en/function.stats-cdf-t.php
 * @param float $par1 <p>
 * 
 * </p>
 * @param float $par2 <p>
 * 
 * </p>
 * @param int $which <p>
 * 
 * </p>
 * @return float 
 */
function stats_cdf_t ($par1, $par2, $which) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-cdf-uniform.php
 * @param float $par1 <p>
 * 
 * </p>
 * @param float $par2 <p>
 * 
 * </p>
 * @param float $par3 <p>
 * 
 * </p>
 * @param int $which <p>
 * 
 * </p>
 * @return float 
 */
function stats_cdf_uniform ($par1, $par2, $par3, $which) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-cdf-weibull.php
 * @param float $par1 <p>
 * 
 * </p>
 * @param float $par2 <p>
 * 
 * </p>
 * @param float $par3 <p>
 * 
 * </p>
 * @param int $which <p>
 * 
 * </p>
 * @return float 
 */
function stats_cdf_weibull ($par1, $par2, $par3, $which) { }

/**
 * Computes the covariance of two data sets
 * @link http://php.net/manual/en/function.stats-covariance.php
 * @param array $a <p>
 * 
 * </p>
 * @param array $b <p>
 * 
 * </p>
 * @return float 
 */
function stats_covariance ($a, $b) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-den-uniform.php
 * @param float $x <p>
 * 
 * </p>
 * @param float $a <p>
 * 
 * </p>
 * @param float $b <p>
 * 
 * </p>
 * @return float 
 */
function stats_den_uniform ($x, $a, $b) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-dens-beta.php
 * @param float $x <p>
 * 
 * </p>
 * @param float $a <p>
 * 
 * </p>
 * @param float $b <p>
 * 
 * </p>
 * @return float 
 */
function stats_dens_beta ($x, $a, $b) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-dens-cauchy.php
 * @param float $x <p>
 * 
 * </p>
 * @param float $ave <p>
 * 
 * </p>
 * @param float $stdev <p>
 * 
 * </p>
 * @return float 
 */
function stats_dens_cauchy ($x, $ave, $stdev) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-dens-chisquare.php
 * @param float $x <p>
 * 
 * </p>
 * @param float $dfr <p>
 * 
 * </p>
 * @return float 
 */
function stats_dens_chisquare ($x, $dfr) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-dens-exponential.php
 * @param float $x <p>
 * 
 * </p>
 * @param float $scale <p>
 * 
 * </p>
 * @return float 
 */
function stats_dens_exponential ($x, $scale) { }

/**
 * 
 * @link http://php.net/manual/en/function.stats-dens-f.php
 * @param float $x <p>
 * 
 * </p>
 * @param float $dfr1 <p>
 * 
 * </p>
 * @param float $dfr2 <p>
 * 
 * </p>
 * @return float 
 */
function stats_dens_f ($x, $dfr1, $dfr2) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-dens-gamma.php
 * @param float $x <p>
 * 
 * </p>
 * @param float $shape <p>
 * 
 * </p>
 * @param float $scale <p>
 * 
 * </p>
 * @return float 
 */
function stats_dens_gamma ($x, $shape, $scale) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-dens-laplace.php
 * @param float $x <p>
 * 
 * </p>
 * @param float $ave <p>
 * 
 * </p>
 * @param float $stdev <p>
 * 
 * </p>
 * @return float 
 */
function stats_dens_laplace ($x, $ave, $stdev) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-dens-logistic.php
 * @param float $x <p>
 * 
 * </p>
 * @param float $ave <p>
 * 
 * </p>
 * @param float $stdev <p>
 * 
 * </p>
 * @return float 
 */
function stats_dens_logistic ($x, $ave, $stdev) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-dens-negative-binomial.php
 * @param float $x <p>
 * 
 * </p>
 * @param float $n <p>
 * 
 * </p>
 * @param float $pi <p>
 * 
 * </p>
 * @return float 
 */
function stats_dens_negative_binomial ($x, $n, $pi) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-dens-normal.php
 * @param float $x <p>
 * 
 * </p>
 * @param float $ave <p>
 * 
 * </p>
 * @param float $stdev <p>
 * 
 * </p>
 * @return float 
 */
function stats_dens_normal ($x, $ave, $stdev) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-dens-pmf-binomial.php
 * @param float $x <p>
 * 
 * </p>
 * @param float $n <p>
 * 
 * </p>
 * @param float $pi <p>
 * 
 * </p>
 * @return float 
 */
function stats_dens_pmf_binomial ($x, $n, $pi) { }

/**
 * 
 * @link http://php.net/manual/en/function.stats-dens-pmf-hypergeometric.php
 * @param float $n1 <p>
 * 
 * </p>
 * @param float $n2 <p>
 * 
 * </p>
 * @param float $N1 <p>
 * 
 * </p>
 * @param float $N2 <p>
 * 
 * </p>
 * @return float 
 */
function stats_dens_pmf_hypergeometric ($n1, $n2, $N1, $N2) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-dens-pmf-poisson.php
 * @param float $x <p>
 * 
 * </p>
 * @param float $lb <p>
 * 
 * </p>
 * @return float 
 */
function stats_dens_pmf_poisson ($x, $lb) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-dens-t.php
 * @param float $x <p>
 * 
 * </p>
 * @param float $dfr <p>
 * 
 * </p>
 * @return float 
 */
function stats_dens_t ($x, $dfr) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-dens-weibull.php
 * @param float $x <p>
 * 
 * </p>
 * @param float $a <p>
 * 
 * </p>
 * @param float $b <p>
 * 
 * </p>
 * @return float 
 */
function stats_dens_weibull ($x, $a, $b) { }

/**
 * Returns the harmonic mean of an array of values
 * @link http://php.net/manual/en/function.stats-harmonic-mean.php
 * @param array $a <p>
 * 
 * </p>
 * @return number 
 */
function stats_harmonic_mean ($a) { }

/**
 * Computes the kurtosis of the data in the array
 * @link http://php.net/manual/en/function.stats-kurtosis.php
 * @param array $a <p>
 * 
 * </p>
 * @return float 
 */
function stats_kurtosis ($a) { }

/**
 * Returns a random deviate from the beta distribution with parameters A and B. The density of the beta 
 * is x^(a-1) * (1-x)^(b-1) / B(a,b) for 0 < x <. Method R. C. H. Cheng.
 * @link http://php.net/manual/en/function.stats-rand-gen-beta.php
 * @param float $a <p>
 * 
 * </p>
 * @param float $b <p>
 * 
 * </p>
 * @return float 
 */
function stats_rand_gen_beta ($a, $b) { }

/**
 * Generates random deviate from the distribution of a chisquare with "df" degrees of freedom random 
 * variable.
 * @link http://php.net/manual/en/function.stats-rand-gen-chisquare.php
 * @param float $df <p>
 * 
 * </p>
 * @return float 
 */
function stats_rand_gen_chisquare ($df) { }

/**
 * Generates a single random deviate from an exponential distribution with mean "av"
 * @link http://php.net/manual/en/function.stats-rand-gen-exponential.php
 * @param float $av <p>
 * 
 * </p>
 * @return float 
 */
function stats_rand_gen_exponential ($av) { }

/**
 * Generates a random deviate from the F (variance ratio) distribution with "dfn" degrees of freedom in 
 * the numerator and "dfd" degrees of freedom in the denominator. Method : directly generates ratio of 
 * chisquare variates.
 * @link http://php.net/manual/en/function.stats-rand-gen-f.php
 * @param float $dfn <p>
 * 
 * </p>
 * @param float $dfd <p>
 * 
 * </p>
 * @return float 
 */
function stats_rand_gen_f ($dfn, $dfd) { }

/**
 * Generates uniform float between low (exclusive) and high (exclusive)
 * @link http://php.net/manual/en/function.stats-rand-gen-funiform.php
 * @param float $low <p>
 * 
 * </p>
 * @param float $high <p>
 * 
 * </p>
 * @return float 
 */
function stats_rand_gen_funiform ($low, $high) { }

/**
 * Generates random deviates from the gamma distribution whose density is (A**R)/Gamma(R) * X**(R-1) * 
 * Exp(-A*X).
 * @link http://php.net/manual/en/function.stats-rand-gen-gamma.php
 * @param float $a <p>
 * location parameter of Gamma distribution (a > 0).
 * </p>
 * @param float $r <p>
 * shape parameter of Gamma distribution (r > 0).
 * </p>
 * @return float 
 */
function stats_rand_gen_gamma ($a, $r) { }

/**
 * Generates a single random deviate from a negative binomial distribution. Arguments : n - the number 
 * of trials in the negative binomial distribution from which a random deviate is to be generated (n > 
 * 0), p - the probability of an event (0 < p < 1)).
 * @link http://php.net/manual/en/function.stats-rand-gen-ibinomial-negative.php
 * @param int $n <p>
 * 
 * </p>
 * @param float $p <p>
 * 
 * </p>
 * @return int 
 */
function stats_rand_gen_ibinomial_negative ($n, $p) { }

/**
 * Generates a single random deviate from a binomial distribution whose number of trials is "n" (n >= 
 * 0) and whose probability of an event in each trial is "pp" ([0;1]). Method : algorithm BTPE
 * @link http://php.net/manual/en/function.stats-rand-gen-ibinomial.php
 * @param int $n <p>
 * 
 * </p>
 * @param float $pp <p>
 * 
 * </p>
 * @return int 
 */
function stats_rand_gen_ibinomial ($n, $pp) { }

/**
 * Generates random integer between 1 and 2147483562
 * @link http://php.net/manual/en/function.stats-rand-gen-int.php
 * @return int 
 */
function stats_rand_gen_int () { }

/**
 * Generates a single random deviate from a Poisson distribution with mean "mu" (mu >= 0.0).
 * @link http://php.net/manual/en/function.stats-rand-gen-ipoisson.php
 * @param float $mu <p>
 * 
 * </p>
 * @return int 
 */
function stats_rand_gen_ipoisson ($mu) { }

/**
 * Generates integer uniformly distributed between LOW (inclusive) and HIGH (inclusive)
 * @link http://php.net/manual/en/function.stats-rand-gen-iuniform.php
 * @param int $low <p>
 * 
 * </p>
 * @param int $high <p>
 * 
 * </p>
 * @return int 
 */
function stats_rand_gen_iuniform ($low, $high) { }

/**
 * Generates random deviate from the distribution of a noncentral chisquare with "df" degrees of 
 * freedom and noncentrality parameter "xnonc". d must be >= 1.0, xnonc must >= 0.0
 * @link http://php.net/manual/en/function.stats-rand-gen-noncenral-chisquare.php
 * @param float $df <p>
 * 
 * </p>
 * @param float $xnonc <p>
 * 
 * </p>
 * @return float 
 */
function stats_rand_gen_noncenral_chisquare ($df, $xnonc) { }

/**
 * Generates a random deviate from the noncentral F (variance ratio) distribution with "dfn" degrees of 
 * freedom in the numerator, and "dfd" degrees of freedom in the denominator, and noncentrality 
 * parameter "xnonc". Method : directly generates ratio of noncentral numerator chisquare variate to 
 * central denominator chisquare variate.
 * @link http://php.net/manual/en/function.stats-rand-gen-noncentral-f.php
 * @param float $dfn <p>
 * 
 * </p>
 * @param float $dfd <p>
 * 
 * </p>
 * @param float $xnonc <p>
 * 
 * </p>
 * @return float 
 */
function stats_rand_gen_noncentral_f ($dfn, $dfd, $xnonc) { }

/**
 * Generates a single random deviate from a noncentral T distribution
 * @link http://php.net/manual/en/function.stats-rand-gen-noncentral-t.php
 * @param float $df <p>
 * 
 * </p>
 * @param float $xnonc <p>
 * 
 * </p>
 * @return float 
 */
function stats_rand_gen_noncentral_t ($df, $xnonc) { }

/**
 * Generates a single random deviate from a normal distribution with mean, av, and standard deviation, 
 * sd (sd >= 0). Method : Renames SNORM from TOMS as slightly modified by BWB to use RANF instead of 
 * SUNIF.
 * @link http://php.net/manual/en/function.stats-rand-gen-normal.php
 * @param float $av <p>
 * 
 * </p>
 * @param float $sd <p>
 * 
 * </p>
 * @return float 
 */
function stats_rand_gen_normal ($av, $sd) { }

/**
 * Generates a single random deviate from a T distribution
 * @link http://php.net/manual/en/function.stats-rand-gen-t.php
 * @param float $df <p>
 * 
 * </p>
 * @return float 
 */
function stats_rand_gen_t ($df) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-rand-get-seeds.php
 * @return array 
 */
function stats_rand_get_seeds () { }

/**
 * generate two seeds for the RGN random number generator
 * @link http://php.net/manual/en/function.stats-rand-phrase-to-seeds.php
 * @param string $phrase <p>
 * 
 * </p>
 * @return array 
 */
function stats_rand_phrase_to_seeds ($phrase) { }

/**
 * Returns a random floating point number from a uniform distribution over 0 - 1 (endpoints of this 
 * interval are not returned) using the current generator
 * @link http://php.net/manual/en/function.stats-rand-ranf.php
 * @return float 
 */
function stats_rand_ranf () { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-rand-setall.php
 * @param int $iseed1 <p>
 * 
 * </p>
 * @param int $iseed2 <p>
 * 
 * </p>
 * @return void 
 */
function stats_rand_setall ($iseed1, $iseed2) { }

/**
 * Computes the skewness of the data in the array
 * @link http://php.net/manual/en/function.stats-skew.php
 * @param array $a <p>
 * 
 * </p>
 * @return float 
 */
function stats_skew ($a) { }

/**
 * Returns the standard deviation
 * @link http://php.net/manual/en/function.stats-standard-deviation.php
 * @param array $a <p>
 * 
 * </p>
 * @param bool $sample <p>
 * 
 * </p>
 * @return float 
 */
function stats_standard_deviation ($a, $sample = false) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-stat-binomial-coef.php
 * @param int $x <p>
 * 
 * </p>
 * @param int $n <p>
 * 
 * </p>
 * @return float 
 */
function stats_stat_binomial_coef ($x, $n) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-stat-correlation.php
 * @param array $arr1 <p>
 * 
 * </p>
 * @param array $arr2 <p>
 * 
 * </p>
 * @return float 
 */
function stats_stat_correlation ($arr1, $arr2) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-stat-gennch.php
 * @param int $n <p>
 * 
 * </p>
 * @return float 
 */
function stats_stat_gennch ($n) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-stat-independent-t.php
 * @param array $arr1 <p>
 * 
 * </p>
 * @param array $arr2 <p>
 * 
 * </p>
 * @return float 
 */
function stats_stat_independent_t ($arr1, $arr2) { }

/**
 * 
 * @link http://php.net/manual/en/function.stats-stat-innerproduct.php
 * @param array $arr1 <p>
 * 
 * </p>
 * @param array $arr2 <p>
 * 
 * </p>
 * @return float 
 */
function stats_stat_innerproduct ($arr1, $arr2) { }

/**
 * Calculates any one parameter of the noncentral t distribution give values for the others.
 * @link http://php.net/manual/en/function.stats-stat-noncentral-t.php
 * @param float $par1 <p>
 * 
 * </p>
 * @param float $par2 <p>
 * 
 * </p>
 * @param float $par3 <p>
 * 
 * </p>
 * @param int $which <p>
 * 
 * </p>
 * @return float 
 */
function stats_stat_noncentral_t ($par1, $par2, $par3, $which) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-stat-paired-t.php
 * @param array $arr1 <p>
 * 
 * </p>
 * @param array $arr2 <p>
 * 
 * </p>
 * @return float 
 */
function stats_stat_paired_t ($arr1, $arr2) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-stat-percentile.php
 * @param float $df <p>
 * 
 * </p>
 * @param float $xnonc <p>
 * 
 * </p>
 * @return float 
 */
function stats_stat_percentile ($df, $xnonc) { }

/**
 * Not documented
 * @link http://php.net/manual/en/function.stats-stat-powersum.php
 * @param array $arr <p>
 * 
 * </p>
 * @param float $power <p>
 * 
 * </p>
 * @return float 
 */
function stats_stat_powersum ($arr, $power) { }

/**
 * Returns the population variance
 * @link http://php.net/manual/en/function.stats-variance.php
 * @param array $a <p>
 * 
 * </p>
 * @param bool $sample <p>
 * 
 * </p>
 * @return float 
 */
function stats_variance ($a, $sample = false) { }

// end php_stats PECL

?>
